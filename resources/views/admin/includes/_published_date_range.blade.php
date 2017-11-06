<div class="col-sm-3 m-b-xs" id="daterange">
    <div class="input-daterange input-group" id="datepicker">
        <input type="text" class="input-sm form-control" name="published_start_date"
               value="{{ request('published_start_date', optional($oldestModel)->published_at) }}"/>
        <span class="input-group-addon">to</span>
        <input type="text" class="input-sm form-control" name="published_end_date"
               value="{{request('published_end_date', optional($latestModel)->published_at) }}"/>
    </div>
</div>