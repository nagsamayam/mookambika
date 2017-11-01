@extends('layouts.admin')
@section('content')
    @include('errors.list')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <h5>Add News Item
                        </h5>
                        @include('admin.buttons.back_to_list', ['route' => 'news'])
                    </div>
                </div>
                <div class="ibox-content">
                    {!! Form::model($news, ['route' => 'news.store', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @include('admin.news._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
