@section('styles')
    <link href="/css/admin/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/css/admin/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="/css/admin/plugins/select2/select2.min.css" rel="stylesheet">
@endsection
<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
    {!! Form::label('content', 'Content', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('content', null, ['id' => 'content','class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group {{ $errors->has('published_at') ? ' has-error' : '' }}" id="data_1">
    {!! Form::label('published_at', 'Publish On', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-3">
        {!! Form::date('published_at', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('tags', 'Tags', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-6">
        {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list','class' => 'form-control', 'multiple']) !!}
    </div>
</div>
@include('admin.includes._form_submit_btn', ['cancelRoute' => 'news'])
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