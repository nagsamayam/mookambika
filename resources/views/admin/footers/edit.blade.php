@extends('layouts.admin')

@section('content')
    @include('errors.list')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <h5>Edit FAQs Item
                        </h5>
                        @include('admin.buttons.add', ['route' => 'faqs.create'])
                        @include('admin.buttons.back_to_list', ['route' => 'faqs'])
                    </div>
                </div>
                <div class="ibox-content">
                    {!! Form::model($faq, ['route' => ['faqs.update', $faq->id], 'method' => 'put', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @include('admin.faqs._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection