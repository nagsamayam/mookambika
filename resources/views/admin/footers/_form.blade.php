@section('styles')
    <link href="/css/admin/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/css/admin/plugins/select2/select2.min.css" rel="stylesheet">
@endsection
<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title', ['class' => 'col-sm-2 control-label required']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Column One(1)</label>

    <div class="col-sm-10">
        @for ($i=0; $i < 2; $i++)
            <div class="row">
                <div class="col-md-4{{ $errors->has('col1_titles.'. $i) ? ' has-error' : '' }}">
                    <input type="text" placeholder="Title" class="form-control" name="col1_titles[{{$i}}]"
                           value="{{old('col1_titles.'.$i)}}">
                </div>
                <div class="col-md-4{{ $errors->has('col1_links.'.$i) ? ' has-error' : '' }}">
                    <input type="text" placeholder="Link" class="form-control" name="col1_links[{{$i}}]"
                           value="{{old('col1_links.'.$i)}}">
                </div>
                <div class="col-md-2">
                    <input type="checkbox" class="check i-checks" name="col1_link_targets[{{$i}}]"
                            {{ (is_array(old('col1_link_targets')) && in_array($i, old('col1_link_targets'))) ? ' checked' : '' }}>
                    (
                    <small> Open in new window</small>
                </div>
            </div>
            <br/>
        @endfor
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Column Two(2)</label>

    <div class="col-sm-10">
        @for ($i=0; $i < 1; $i++)
            <div class="row">
                <div class="col-md-4{{ $errors->has('col2_titles.'. $i) ? ' has-error' : '' }}">
                    <input type="text" placeholder="Title" class="form-control" name="col2_titles[{{$i}}]"
                           value="{{old('col2_titles.'.$i)}}">
                </div>
                <div class="col-md-4{{ $errors->has('col2_links.'.$i) ? ' has-error' : '' }}">
                    <input type="text" placeholder="Link" class="form-control" name="col2_links[{{$i}}]"
                           value="{{old('col2_links.'.$i)}}">
                </div>
                <div class="col-md-2">
                    <input type="checkbox" class="check i-checks" name="col2_link_targets[{{$i}}]"
                            {{ (is_array(old('col2_link_targets')) && in_array($i, old('col2_link_targets'))) ? ' checked' : '' }}> (
                    <small> Open in new window</small>
                </div>
            </div>
            <br/>
        @endfor
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Column Three(3)</label>

    <div class="col-sm-10">
        @for ($i=0; $i < 1; $i++)
            <div class="row">
                <div class="col-md-4{{ $errors->has('col3_titles.'. $i) ? ' has-error' : '' }}">
                    <input type="text" placeholder="Title" class="form-control" name="col3_titles[{{$i}}]"
                           value="{{old('col3_titles.'.$i)}}">
                </div>
                <div class="col-md-4{{ $errors->has('col3_links.'.$i) ? ' has-error' : '' }}">
                    <input type="text" placeholder="Link" class="form-control" name="col3_links[{{$i}}]"
                           value="{{old('col3_links.'.$i)}}">
                </div>
                <div class="col-md-2">
                    <input type="checkbox" class="check i-checks" name="col3_link_targets[{{$i}}]"
                            {{ (is_array(old('col3_link_targets')) && in_array($i, old('col3_link_targets'))) ? ' checked' : '' }}> (
                    <small> Open in new window</small>
                </div>
            </div>
            <br/>
        @endfor
    </div>
</div>
@include('admin.includes._form_submit_btn', ['cancelRoute' => 'faqs'])
@section('scripts')
    <script src="/js/admin/plugins/iCheck/icheck.min.js"></script>
    <script src="/js/admin/plugins/select2/select2.full.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
            });

        });
    </script>
@endsection