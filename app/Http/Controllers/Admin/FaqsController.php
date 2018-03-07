<?php

namespace App\Http\Controllers\Admin;

use App\Filters\FaqFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index(Request $request, FaqFilters $filters)
    {
        $faqs = $this->getFaqs($filters);
        $faqCount = $faqs->total();
        $tags = tagsForDropdown(Faq::with('tags:id,title')->get());
        $latestFaq = Faq::latestRecord();
        $oldestFaq = Faq::oldestRecord();
        $faqs->withPath(request()->getUri());

        return view('admin.faqs.index', compact(
            'faqs', 'faqCount', 'tags',
            'latestFaq', 'oldestFaq'));
    }

    public function create(Faq $faq)
    {
        $tags = Tag::pluck('title', 'id');

        return view('admin.faqs.create', compact('faq', 'tags'));
    }

    public function store(FaqRequest $request)
    {
        $this->_createFaqs($request);
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('faqs'))->with($notification);
    }

    public function edit(Faq $faq)
    {
        $tags = Tag::pluck('title', 'id');

        return view('admin.Faqs.edit', compact('faq', 'tags'));
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update($this->_params($request));
        $this->_syncTags($faq, $request->get('tag_list'));
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('faqs'))->with($notification);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        $notification = $this->notification('Deleted successfully', 'success');

        return redirect(route('faqs'))->with($notification);
    }

    public function bulkAction(Request $request)
    {
        $action = $request->get('action_type');
        $ids = $request->get('faq_ids');
        Faq::destroy($ids);
        $notification = $this->notification(ucfirst($action).'ed successfully', 'success');

        return redirect(route('faqs'))->with($notification);
    }

    protected function getFaqs(FaqFilters $filters)
    {
        $perPage = (int) request('per_page');
        $perPage = $perPage > 0 ? $perPage : 25;

        return Faq::filter($filters)
            ->recent()
            ->paginate($perPage, ['id', 'title', 'published_at']);
    }

    private function _syncTags(Faq $faq, array $tags)
    {
        $faq->syncTags($tags);
    }

    private function _createFaqs(FaqRequest $request)
    {
        $faq = Auth::user()->faqs()
            ->create($this->_params($request));
        $this->_syncTags($faq, $request->get('tag_list'));

        return $faq;
    }

    private function _params(FaqRequest $request)
    {
        return $request->only(
            ['title', 'content', 'published_at']
        );
    }
}
