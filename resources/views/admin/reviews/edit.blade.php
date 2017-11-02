@extends('layouts.admin')

@section('content')
    @include('errors.list')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <h5>Edit Review Item
                        </h5>
                        @include('admin.buttons.add', ['route' => 'reviews.create'])
                        @include('admin.buttons.back_to_list', ['route' => 'reviews'])
                    </div>
                </div>
                <div class="ibox-content">
                    {!! Form::model($review, ['route' => ['reviews.update', $review->id], 'method' => 'put', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @include('admin.reviews._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection