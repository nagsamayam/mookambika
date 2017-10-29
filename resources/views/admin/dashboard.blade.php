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
            <form>
                {{ csrf_field() }}
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <h5>Dashboard</h5>

                            <div class="ibox-tools">
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
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
@endsection