<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Filters\SectionFilters;
use App\Http\Controllers\Controller;

class SectionsController extends Controller
{
    public function index(Request $request, SectionFilters $filters)
    {
        $perPage = (int)$request->get('per_page');
        $perPage = $perPage > 0 ? $perPage : 25;

        $sections = Section::filter($filters)->paginate($perPage, ['id', 'title']);
        $sections->withPath(request()->getUri());
        $sectionCount = $sections->total();

        return view('admin.sections.index', compact('sections', 'sectionCount'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $data = $this->_validateInput();
        Section::create($data);
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('sections'))->with($notification);
    }

    public function edit($id)
    {
        $section = Section::find($id);

        return view('admin.sections.edit', compact('section'));
    }

    public function update(Section $section)
    {
        $data = $this->_validateInput();
        $section->update($data);
        $notification = $this->notification('Saved successfully', 'success');

        return redirect(route('sections'))->with($notification);
    }

    public function destroy(Section $section)
    {
        $section->delete();
        $notification = $this->notification('Deleted successfully', 'success');

        return redirect(route('sections'))->with($notification);
    }

    public function bulkAction(Request $request)
    {
        $action = $request->get('action_type');
        $ids = $request->get('section_ids');
        Section::destroy($ids);
        $notification = $this->notification(ucfirst($action) . 'ed successfully', 'success');

        return redirect(route('sections'))->with($notification);
    }

    private function _validateInput()
    {
        $data = $this->validate(request(), [
            'title' => 'required|min:3|max:150',
        ]);

        $filters = [
            'title' => 'strip_tags|trim|lowercase',
        ];

        return \Sanitizer::make($data, $filters)->sanitize();
    }
}
