<div class="col-sm-3 m-b-xs" id="daterange">
    <div class="input-daterange input-group" id="datepicker">
        <input type="text" class="input-sm form-control" name="start_date"
               value="{{ request('start_date', optional($oldestModel)->createdDate) }}"/>
        <span class="input-group-addon">to</span>
        <input type="text" class="input-sm form-control" name="end_date"
               value="{{request('end_date', optional($latestModel)->createdDate) }}"/>
    </div>
</div>