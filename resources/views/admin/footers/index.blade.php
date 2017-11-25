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
                    <h5>Footer Filters</h5>

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
                    <form action="{{ route('footers') }}" method="get">
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="input-group">
                                    @include('admin.includes._input_number_of_records')
                                </div>
                            </div>
                            <div class="col-sm-2 m-b-xs">
                                <select class="input-md  form-control input-s-sm inline" name="status">
                                    <option value="">Select Status</option>
                                    <option value="published" {{ request('status') === 'published' ? "selected":"" }}>
                                        Published
                                    </option>
                                    <option value="unpublished" {{ request('status') === 'unpublished' ? "selected":"" }}>
                                        Unpublished
                                    </option>
                                </select>
                            </div>
                            @include('admin.includes._created_date_range', ['oldestModel' => $oldestFooter, 'latestModel' => $latestFooter])
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group">
                                    @include('admin.includes._input_search_box')
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <a class="btn btn-md btn-default"
                                   href="{{ route('footers') }}"
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
            <form method="post" id="footer_form" action="{{ route('footers.actions') }}">
                {{ csrf_field() }}
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <h5>Footer</h5>

                            <div class="ibox-tools">
                                @include('admin.buttons.reload', ['route' => 'footers'])
                                @include('admin.buttons.add', ['route' => 'footers.create'])
                                <button class="btn btn-rounded btn-warning btn-sm" type="button" title="Publish"
                                        onclick="footer_action('publish');"><i class="fa fa-globe"></i> Publish
                                </button>
                                <button class="btn btn-rounded btn-alert btn-sm" type="button" title="Unpublish"
                                        onclick="footer_action('unpublish');"><i class="fa fa-globe"></i> Unpublish
                                </button>
                                <button class="btn btn-rounded btn-danger btn-sm" type="button"
                                        onclick="footer_action('delete');"><i
                                            class="fa fa-trash"></i> Delete
                                </button>
                                <input type="hidden" name="action_type" id="action_type">
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
                        @include('admin.includes._records_count_bs_alert', ['total' => $footerCount, 'btn_class' => $footerCount > 0 ? 'info' : 'danger'])
                        @if($footerCount > 0)
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th style="width:5%;"><input type="checkbox" id="check_all" class="i-checks"/>
                                    </th>
                                    <th data-hide="phone">Title</th>
                                    <th data-hide="phone">Created on</th>
                                    <th data-hide="phone">Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($footers as $footer)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="check i-checks" name="footer_ids[]"
                                                   id="footer_{{ $footer->id }}" value="{{ $footer->id }}">
                                        </td>
                                        <td>
                                            {{$footer->title}}
                                        </td>
                                        <td>
                                            {{$footer->created_at->toFormattedDateString()}}
                                        </td>
                                        <td>
                                        <span class="label label-{{ $footer->trashed() ? 'danger' : 'primary'}}">
                                        {{ $footer->trashed() ? 'Deleted' : 'Active' }}
                                        </span>
                                        </td>
                                        <td class="text-right">
                                            @if($footer->isActive())
                                                @include('admin.buttons.edit', ['route' => 'footers.edit', 'model' => $footer ])
                                                @include('admin.buttons.delete', ['href' => '/secure/footers/'.$footer->id])
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        {{ $footers->links() }}
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
        $(document).ready(function () {
            $('#daterange .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "yyyy-mm-dd",
                startDate: "<?php echo optional($oldestFooter)->createdDate; ?>",
                endDate: "<?php echo optional($latestFooter)->createdDate; ?>"
            });
        });
        @include('admin.includes._toaster')
    </script>
    <script src="/js/admin/bulk_actions.js"></script>
    <script src="/js/admin/delete_item.js"></script>
@endsection