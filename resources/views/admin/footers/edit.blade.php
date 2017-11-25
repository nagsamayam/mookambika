@extends('layouts.admin')

@section('content')
    @include('errors.list')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <h5>Edit Footer Item
                        </h5>
                        @include('admin.buttons.add', ['route' => 'footers.create'])
                        @include('admin.buttons.back_to_list', ['route' => 'footers'])
                    </div>
                </div>
                <div class="ibox-content">
                    {!! Form::model($footer, ['route' => ['footers.update', $footer->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    @include('admin.footers._edit_form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection