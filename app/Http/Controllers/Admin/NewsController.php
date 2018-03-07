<?php

namespace App\Http\Controllers\Admin;

use App\Filters\NewsFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request, NewsFilters $filters)
    {
        $news = $this->getNews($filters);
        $newsCount = $news->total();
        $tags = tagsForDropdown(News::with('tags')->get());
        $latestNews = News::latestRecord();
        $oldestNews = News::oldestRecord();
        $news->withPath(request()->getUri());

        return view('admin.news.index', compact(
            'news', 'newsCount', 'tags',
            'latestNews', 'oldestNews'));
    }

    public function create(News $news)
    {
        $tags = Tag::pluck('title', 'id');

        return view('admin.news.create', compact('news', 'tags'));
    }

    public function store(NewsRequest $request)
    {
        $this->_createNews($request);
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('news'))->with($notification);
    }

    public function edit(News $news)
    {
        $tags = Tag::pluck('title', 'id');

        return view('admin.news.edit', compact('news', 'tags'));
    }

    public function update(NewsRequest $request, News $news)
    {
        $news->update($this->_params($request));
        $this->_syncTags($news, $request->get('tag_list'));
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('news'))->with($notification);
    }

    public function destroy(News $news)
    {
        $news->delete();
        $notification = $this->notification('Deleted successfully', 'success');

        return redirect(route('news'))->with($notification);
    }

    public function bulkAction(Request $request)
    {
        $action = $request->get('action_type');
        $ids = $request->get('news_ids');
        News::destroy($ids);
        $notification = $this->notification(ucfirst($action).'ed successfully', 'success');

        return redirect(route('news'))->with($notification);
    }

    protected function getNews(NewsFilters $filters)
    {
        $perPage = (int) request('per_page');
        $perPage = $perPage > 0 ? $perPage : 25;

        return News::filter($filters)
            ->recent()
            ->paginate($perPage, ['id', 'title', 'published_at']);
    }

    private function _syncTags(News $news, array $tags)
    {
        $news->syncTags($tags);
    }

    private function _createNews(NewsRequest $request)
    {
        $news = Auth::user()->news()
            ->create($this->_params());
        $this->_syncTags($news, $request->get('tag_list'));

        return $news;
    }

    private function _params()
    {
        return request()->only(
            ['title', 'content', 'published_at']
        );
    }
}
