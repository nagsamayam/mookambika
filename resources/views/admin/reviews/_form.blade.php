@section('styles')
    <link href="/css/admin/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/css/admin/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="/css/admin/plugins/select2/select2.min.css" rel="stylesheet">
@endsection
<div class="form-group {{ $errors->has('reviewer_name') ? ' has-error' : '' }}">
    {!! Form::label('reviewer_name', 'Reviewer name', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-4">
        {!! Form::text('reviewer_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group {{ $errors->has('avatar') ? ' has-error' : '' }}">
    {!! Form::label('avatar', 'Reviewer Avatar', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-6">
        <div class="col-sm-8">
            <img src="{{ $review->avatar }}"><br/> <br/>
            {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('rating') ? ' has-error' : '' }}">
    {!! Form::label('reviewer_name', 'Rating', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-2">
        {!! Form::text('rating', null, ['class' => 'form-control']) !!}
        <span>(1, 1.5, 2, 2.5 ... 4.5, 5)</span>
    </div>
</div>
<div class="form-group {{ $errors->has('reviewer_designation') ? ' has-error' : '' }}">
    {!! Form::label('reviewer_designation', 'Reviewer designation', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-4">
        {!! Form::text('reviewer_designation', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group {{ $errors->has('reviewer_organization') ? ' has-error' : '' }}">
    {!! Form::label('reviewer_organization', 'Reviewer organization', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-6">
        {!! Form::text('reviewer_organization', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('reviewer_location') ? ' has-error' : '' }}">
    {!! Form::label('reviewer_location', 'Reviewer location', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-6">
        {!! Form::text('reviewer_location', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
    {!! Form::label('content', 'Content', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('content', null, ['id' => 'content','class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('tags', 'Tags', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-6">
        {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list','class' => 'form-control', 'multiple']) !!}
    </div>
</div>
@include('admin.includes._form_submit_btn', ['cancelRoute' => 'reviews'])
@section('scripts')
    <script src="/js/admin/plugins/summernote/summernote.min.js"></script>
    <script src="/js/admin/plugins/select2/select2.full.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#content').summernote();
            $("#tag_list").select2({
                tags: true,
            });
        });
    </script>
@endsection