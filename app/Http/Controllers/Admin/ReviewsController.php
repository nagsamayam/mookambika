<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Storage;
use App\Models\Tag;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Filters\ReviewFilters;
use App\Http\Requests\ReviewRequest;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{
    public function index(Request $request, ReviewFilters $filters)
    {
        $reviews = $this->getReviews($filters);
        $reviewCount = $reviews->total();
        $tags = tagsForDropdown(Review::with('tags:id,title')->get());
        $latestReview = Review::latestRecord();
        $oldestReview = Review::oldestRecord();
        $reviews->withPath(request()->getUri());

        return view('admin.reviews.index', compact(
            'reviews', 'reviewCount', 'tags',
            'latestReview', 'oldestReview'));
    }

    public function create(Review $review)
    {
        $tags = Tag::pluck('title', 'id');

        return view('admin.reviews.create', compact('review', 'tags'));
    }

    public function store(ReviewRequest $request)
    {
        $this->_createReviews($request);
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('reviews'))->with($notification);
    }

    public function edit(Review $review)
    {
        $tags = Tag::pluck('title', 'id');

        return view('admin.Reviews.edit', compact('review', 'tags'));
    }

    public function update(ReviewRequest $request, Review $review)
    {
        DB::transaction(function () use ($request, $review) {
            $review->update($this->_params($request));
            $this->_syncTags($review, $request->get('tag_list'));
        });
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('reviews'))->with($notification);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        $notification = $this->notification('Deleted successfully', 'success');

        return redirect(route('Reviews'))->with($notification);
    }

    public function bulkAction(Request $request)
    {
        $action = $request->get('action_type');
        $ids = $request->get('review_ids');
        Review::destroy($ids);
        $notification = $this->notification(ucfirst($action) . 'ed successfully', 'success');

        return redirect(route('reviews'))->with($notification);
    }

    protected function getReviews(ReviewFilters $filters)
    {
        $perPage = (int)request('per_page');
        $perPage = $perPage > 0 ? $perPage : 25;

        return Review::filter($filters)
            ->recent()
            ->paginate($perPage, ['id', 'content', 'published_at']);
    }

    private function _syncTags(Review $review, array $tags)
    {
        $review->syncTags($tags);
    }

    private function _createReviews(ReviewRequest $request)
    {
        $review = DB::transaction(function () use ($request) {
            $review = Auth::user()->reviews()
                ->create($this->_params($request));
            $this->_syncTags($review, $request->get('tag_list'));

            return $review;
        });

        return $review;
    }

    private function _params(ReviewRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->putFile(
                'avatars', $request->file('avatar')
            );
            $request->merge(['reviewer_avatar' => $path]);
        }

        return $request->only(
            [
                'reviewer_name', 'reviewer_avatar', 'reviewer_designation',
                'reviewer_organization', 'reviewer_location', 'rating',
                'content', 'published_at'
            ]
        );
    }
}
