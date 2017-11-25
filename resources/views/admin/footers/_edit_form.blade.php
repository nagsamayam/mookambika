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
        @foreach ($decoded_content->column1 as $i => $column1)
            <div class="row">
                <div class="col-md-4{{ $errors->has('col1_titles.'. $i) ? ' has-error' : '' }}">
                    {!! Form::text("col1_titles[$i]", isset($footer) ? $column1->title : null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                </div>
                <div class="col-md-4{{ $errors->has('col1_links.'.$i) ? ' has-error' : '' }}">
                    {!! Form::text("col1_links[$i]", isset($footer) ? $column1->link : null, ['class' => 'form-control', 'placeholder' => 'URI/Link']) !!}
                </div>
            </div>
            <br/>
        @endforeach
        <a href="#addColumnOne" class="">
            <span class="fa fa-plus-circle" style="margin-right:5px"></span>Add New
        </a>
        <br/>
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Column Two(2)</label>

    <div class="col-sm-10">
        @foreach ($decoded_content->column2 as $i => $column2)
            <div class="row">
                <div class="col-md-4{{ $errors->has('col2_titles.'. $i) ? ' has-error' : '' }}">
                    {!! Form::text("col2_titles[$i]", isset($footer) ? $column2->title : null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                </div>
                <div class="col-md-4{{ $errors->has('col2_links.'.$i) ? ' has-error' : '' }}">
                    {!! Form::text("col2_links[$i]", isset($footer) ? $column2->link : null, ['class' => 'form-control', 'placeholder' => 'URI/Link']) !!}
                </div>
            </div>
            <br/>
        @endforeach
        <a href="#addColumnTwo" class="">
            <span class="fa fa-plus-circle" style="margin-right:5px"></span>Add New
        </a>
        <br/>
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Column Three(3)</label>

    <div class="col-sm-10">
        @foreach ($decoded_content->column3 as $i => $column3)
            <div class="row">
                <div class="col-md-4{{ $errors->has('col3_titles.'. $i) ? ' has-error' : '' }}">
                    {!! Form::text("col3_titles[$i]", isset($footer) ? $column3->title : null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                </div>
                <div class="col-md-4{{ $errors->has('col3_links.'.$i) ? ' has-error' : '' }}">
                    {!! Form::text("col3_links[$i]", isset($footer) ? $column3->link : null, ['class' => 'form-control', 'placeholder' => 'URI/Link']) !!}
                </div>
            </div>
            <br/>
        @endforeach
        <a href="#addColumnThree" class="">
            <span class="fa fa-plus-circle" style="margin-right:5px"></span>Add New
        </a>
    </div>
</div>
@include('admin.includes._form_submit_btn', ['cancelRoute' => 'faqs'])
@section('scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/js/admin/plugins/iCheck/icheck.min.js"></script>
    <script src="/js/admin/plugins/select2/select2.full.min.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <script src="/js/admin/form_class.js"></script>
    <script>
        $(document).ready(function () {
            var col1Cnt = <?php echo count($decoded_content->column1) ?>;
            var col2Cnt = <?php echo count($decoded_content->column2) ?>;
            var col3Cnt = <?php echo count($decoded_content->column3) ?>;
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
            });

            function iChk() {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                });
            }

            $('body').on({
                click: function (e) {
                    e.preventDefault();
                    var k = col1Cnt;
                    $(this).before("<div class=\"row\" style=\"margin-bottom:10px\"><div class=\"col-md-4{{ $errors->has('col1_titles.'."+k+") ? ' has-error' : '' }}\"><input type=\"text\" placeholder=\"Title\" class=\"form-control\" name=\"col1_titles[" + k + "]\" value=\"{{old('col1_titles.'."+k+")}}\"><\/div><div class=\"col-md-4{{ $errors->has('col1_links.'."+k+") ? ' has-error' : '' }}\"><input type=\"text\" placeholder=\"Link\" class=\"form-control\" name=\"col1_links[" + k + "]\" value=\"{{old('col1_links.'."+k+")}}\"><\/div><\/div><br/>");
                    iChk();
                    col1Cnt++;
                }
            }, '[href="#addColumnOne"]');
            $('body').on({
                click: function (e) {
                    e.preventDefault();
                    var k = col2Cnt;
                    $(this).before("<div class=\"row\" style=\"margin-bottom:10px\"><div class=\"col-md-4{{ $errors->has('col2_titles.'."+k+") ? ' has-error' : '' }}\"><input type=\"text\" placeholder=\"Title\" class=\"form-control\" name=\"col2_titles[" + k + "]\" value=\"{{old('col2_titles.'."+k+")}}\"><\/div><div class=\"col-md-4{{ $errors->has('col2_links.'."+k+") ? ' has-error' : '' }}\"><input type=\"text\" placeholder=\"Link\" class=\"form-control\" name=\"col2_links[" + k + "]\" value=\"{{old('col2_links.'."+k+")}}\"><\/div><\/div></br/>");
                    iChk();
                    col2Cnt++;
                }
            }, '[href="#addColumnTwo"]');
            $('body').on({
                click: function (e) {
                    e.preventDefault();
                    var k = col3Cnt;
                    $(this).before("<div class=\"row\" style=\"margin-bottom:10px\"><div class=\"col-md-4{{ $errors->has('col3_titles.'."+k+") ? ' has-error' : '' }}\"><input type=\"text\" placeholder=\"Title\" class=\"form-control\" name=\"col3_titles[" + k + "]\" value=\"{{old('col3_titles.'."+k+")}}\"><\/div><div class=\"col-md-4{{ $errors->has('col3_links.'."+k+") ? ' has-error' : '' }}\"><input type=\"text\" placeholder=\"Link\" class=\"form-control\" name=\"col3_links[" + k + "]\" value=\"{{old('col3_links.'."+k+")}}\"><\/div><\/div><br/>");
                    iChk();
                    col3Cnt++;
                }
            }, '[href="#addColumnThree"]');

        });
    </script>
@endsection