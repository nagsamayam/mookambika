@extends('layouts.admin')
@section('styles')
    <link href="/css/admin/plugins/iCheck/custom.css" rel="stylesheet">
@endsection
@section('page_styles')
    <link href="/css/admin/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/css/admin/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/css/admin/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tag Filters</h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content text-center">
                    <form action="{{ route('tags') }}" method="get">
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="input-group">
                                    @include('admin.includes._input_number_of_records')
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    @include('admin.includes._input_search_box')
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <a class="btn btn-md btn-default" href="{{ route('tags') }}"
                                   style="float: left;background-color: #e7eaec;">
                                    Reset</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form method="post" id="tag_form" action="{{ route('tags.actions') }}">
                {{ csrf_field() }}
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <h5>Tags</h5>

                            <div class="ibox-tools">
                                <a href="{{ route('tags.create') }}" class="btn btn-rounded btn-primary btn-sm"
                                   type="button" title="Add New Tag"><i
                                            class="fa fa-plus-circle"></i> Add New Tag
                                </a>
                                <button class="btn btn-rounded btn-danger btn-sm" type="button"
                                        onclick="tag_action('delete');"><i
                                            class="fa fa-trash"></i> Delete
                                </button>
                                <input type="hidden" name="action_type" id="action_type">
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
                        @include('admin.includes._records_count_bs_alert', ['total' => $tagCount, 'btn_class' => $tagCount > 0 ? 'info' : 'danger'])
                        @if($tagCount > 0)
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th style="width:5%;"><input type="checkbox" id="check_all" class="i-checks"/>
                                    </th>
                                    <th data-hide="phone">Title</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="check i-checks" name="tag_ids[]"
                                                   id="tag_{{ $tag->id }}" value="{{ $tag->id }}">
                                        </td>
                                        <td>
                                            {{$tag->title}}
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown"
                                                        class="btn btn-warning btn-sm dropdown-toggle">Options <span
                                                            class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('tags.edit', [ 'id' => $tag->id ]) }}">
                                                            <i class="fa fa-pencil"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{'/secure/tags/'.$tag->id}}"
                                                           data-token="{{csrf_token()}}"
                                                           data-method="delete"
                                                           data-confirm="Are you sure?">
                                                            <i class="fa fa-trash"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        {{ $tags->links() }}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
    @section('scripts')
            <!-- Data picker -->
    <script src="/js/admin/plugins/datapicker/bootstrap-datepicker.js"></script>
    <!-- iCheck -->
    <script src="/js/admin/plugins/iCheck/icheck.min.js"></script>
    <!-- Date range picker -->
    <script src="/js/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="/js/admin/checkbox_bulk_actions.js"></script>
    <script>
        @include('admin.includes._toaster')
    </script>
    <script src="/js/admin/tag_bulk_actions.js"></script>
    <script src="/js/admin/delete_item.js"></script>
@endsection