<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Filters\TagFilters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{

    public function index(Request $request, TagFilters $filters)
    {
        $perPage = (int)$request->get('per_page');
        $perPage = $perPage > 0 ? $perPage : 25;

        $tags = Tag::latest()
            ->filter($filters)
            ->paginate($perPage, ['id', 'title', 'created_at']);
        $tags->withPath(request()->getUri());
        $tagCount = $tags->total();

        return view('admin.tags.index', compact('tags', 'tagCount'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $data = $this->_validateInput();
        Tag::create($data);
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('tags'))->with($notification);
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Tag $tag)
    {
        $data = $this->_validateInput();
        $tag->update($data);
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('tags'))->with($notification);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        $notification = $this->notification('Deleted successfully', 'success');

        return redirect(route('tags'))->with($notification);
    }

    public function bulkAction(Request $request)
    {
        $action = $request->get('action_type');
        $ids = $request->get('tag_ids');
        Tag::destroy($ids);
        $notification = $this->notification(ucfirst($action) . 'ed successfully', 'success');

        return redirect(route('tags'))->with($notification);
    }

    private function _validateInput()
    {
        $data = $this->validate(request(), [
            'title' => 'bail|required|min:3|max:150',
            'meta_description' => 'bail|sometimes|nullable|min:3',
        ]);

        $filters = [
            'title' => 'strip_tags|trim|lowercase',
            'meta_description' => 'strip_tags|trim|capitalize_first_letter',
        ];

        return \Sanitizer::make($data, $filters)->sanitize();
    }
}
