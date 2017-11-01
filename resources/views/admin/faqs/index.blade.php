@extends('layouts.admin')
@section('styles')
    <link href="/css/admin/plugins/iCheck/custom.css" rel="stylesheet">
@endsection
@section('page_styles')
    <link href="/css/admin/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/css/admin/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/css/admin/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="/css/admin/plugins/select2/select2.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>FAQs Filters</h5>

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
                    <form action="{{ route('faqs') }}" method="get">
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
                            @include('admin.includes._published_date_range', ['oldestModel' => $oldestFaq, 'latestModel' => $latestFaq])
                            <div class="col-sm-4 m-b-xs" id="data_1">
                                @include('admin.includes._taggable_dropdown')
                            </div>
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
                                   href="{{ route('faqs') }}"
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
            <form method="post" id="faq_form" action="{{ route('faqs.actions') }}">
                {{ csrf_field() }}
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <h5>News</h5>

                            <div class="ibox-tools">
                                @include('admin.buttons.reload', ['route' => 'faqs'])
                                @include('admin.buttons.add', ['route' => 'faqs.create'])
                                <button class="btn btn-rounded btn-danger btn-sm" type="button"
                                        onclick="faq_action('delete');"><i
                                            class="fa fa-trash"></i> Delete
                                </button>
                                <input type="hidden" name="action_type" id="action_type">
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
                        @include('admin.includes._records_count_bs_alert', ['total' => $faqCount, 'btn_class' => $faqCount > 0 ? 'info' : 'danger'])
                        @if($faqCount > 0)
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th style="width:5%;"><input type="checkbox" id="check_all" class="i-checks"/>
                                    </th>
                                    <th data-hide="phone">Title</th>
                                    <th data-hide="phone">Tags</th>
                                    <th data-hide="phone">Published on</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($faqs as $faq)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="check i-checks" name="faq_ids[]"
                                                   id="faq_{{ $faq->id }}" value="{{ $faq->id }}">
                                        </td>
                                        <td>
                                            {{$faq->title}}
                                        </td>
                                        <td>
                                            {{ implode(', ', array_slice($faq->tag_title_list,0,2)) }}
                                        </td>
                                        <td>
                                            {{$faq->publishedDate}}
                                        </td>
                                        <td class="text-right">
                                            @include('admin.buttons.edit', ['route' => 'faqs.edit', 'model' => $faq ])
                                            @include('admin.buttons.delete', ['href' => '/secure/faqs/'.$faq->id])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        {{ $faqs->links() }}
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
    <script src="/js/admin/plugins/select2/select2.full.min.js"></script>
    <script src="/js/admin/checkbox_bulk_actions.js"></script>
    <script>
        $(document).ready(function () {
            $("#tags").select2({
                placeholder: "Select a tag"
            });
            $('#daterange .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "yyyy-mm-dd",
                startDate: "<?php echo optional($oldestFaq)->published_at; ?>",
                endDate: "<?php echo optional($latestFaq)->published_at; ?>"
            });
        });
        @include('admin.includes._toaster')
    </script>
    <script src="/js/admin/bulk_actions.js"></script>
    <script src="/js/admin/delete_item.js"></script>
@endsection