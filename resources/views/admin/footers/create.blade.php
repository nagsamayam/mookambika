@extends('layouts.admin')
@section('content')
    @include('errors.list')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <h5>Add Footers Item
                        </h5>
                        @include('admin.buttons.back_to_list', ['route' => 'footers'])
                    </div>
                </div>
                <div class="ibox-content">
                    {!! Form::model($footer, ['route' => 'footers.store', 'class' => 'form-horizontal']) !!}
                    @include('admin.footers._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var i = 1;
            $('#add').click(function () {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
        @include('admin.includes._toaster')
    </script>
@endsection
