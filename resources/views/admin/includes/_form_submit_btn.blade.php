<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <button class="btn btn-white">
            <a href="{{route($cancelRoute)}}">
                Cancel
            </a>
        </button>
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
</div>