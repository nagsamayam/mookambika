<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Footer;
use Illuminate\Http\Request;
use App\Filters\FooterFilters;
use App\Http\Requests\FooterRequest;
use App\Http\Controllers\Controller;

class FootersController extends Controller
{
    public function index(Request $request, FooterFilters $filters)
    {
        $footers = $this->getFooters($filters);
        $footerCount = $footers->total();
        $latestFooter = Footer::latest()->first(['created_at']);
        $oldestFooter = Footer::oldest()->first(['created_at']);
        $footers->withPath(request()->getUri());

        return view('admin.footers.index', compact('footers', 'footerCount',
            'latestFooter', 'oldestFooter'));
    }

    public function create(Footer $footer)
    {
        return view('admin.footers.create', compact('footer'));
    }

    public function store(FooterRequest $request)
    {
        $footer = $this->_createFooter($request);
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('footers'))->with($notification);
    }

    public function edit(Footer $footer)
    {
        $decoded_content = $footer->decodeContent();

        return view('admin.footers.edit', compact('footer', 'decoded_content'));
    }

    public function update(FooterRequest $request, Footer $footer)
    {
        $content = $this->_formatColumsData($request);
        $footer->update([
            'title' => $request->get('title'),
            'user_id' => auth()->user()->id,
            'content' => $content
        ]);
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('footers'))->with($notification);
    }

    public function destroy(Footer $footer)
    {
        $footer->delete();
        $notification = $this->notification('Deleted successfully', 'success');

        return redirect(route('footers'))->with($notification);
    }

    public function bulkAction(Request $request)
    {
        $action = $request->get('action_type');
        $ids = $request->get('footer_ids');
        if ($action === 'unpublish') {
            Footer::whereIn('id', $ids)->delete();
        } elseif ($action === 'publish') {
            Footer::whereIn('id', $ids)->restore();
        } elseif ($action === 'delete') {
            Footer::whereIn('id', $ids)->forceDelete();
        }
        $notification = $this->notification(ucfirst($action) . 'ed successfully', 'success');

        return redirect(route('footers'))->with($notification);
    }

    protected function getFooters($filters)
    {
        $perPage = (int)request('per_page');
        $perPage = $perPage > 0 && $perPage < 100 ? $perPage : 25;

        return Footer::filter($filters)
            ->latest()
            ->unless(request('status'), function ($query) {
                return $query->withTrashed();;
            })
            ->paginate($perPage, ['id', 'title', 'created_at', 'deleted_at']);
    }

    private function _createFooter(FooterRequest $request)
    {
        $content = $this->_formatColumsData($request);
        $footer = Auth::user()->footers()
            ->create([
                'title' => $request->get('title'),
                'content' => $content
            ]);

        return $footer;
    }

    private function formatFormData(array $titles, array $links, array $linkTargets = [])
    {
        $data = [];
        if (count($titles) === count($links) && count($linkTargets)) {
            foreach ($titles as $key1 => $title) {
                foreach ($links as $key2 => $link) {
                    // foreach ($linkTargets as $key3 => $target) {
                    if ($key1 == $key2) {
                        $data[$key1] = ['title' => $title, 'link' => $link, 'new_window' => 'off'];
                    }
                    // }
                }
            }
        }

        return $data;
    }

    private function _formatColumsData($request)
    {
        $col1Data = $this->formatFormData($request->get('col1_titles'), $request->get('col1_links'), $request->get('col1_link_targets') ?? ['off']);
        $col2Data = $this->formatFormData($request->get('col2_titles'), $request->get('col2_links'), $request->get('col2_link_targets') ?? ['off']);
        $col3Data = $this->formatFormData($request->get('col3_titles'), $request->get('col3_links'), $request->get('col3_link_targets') ?? ['off']);

        return json_encode([
            'column1' => $col1Data,
            'column2' => $col2Data,
            'column3' => $col3Data,
        ]);
    }
}
