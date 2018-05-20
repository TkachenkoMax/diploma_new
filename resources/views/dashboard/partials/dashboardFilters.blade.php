<div class="row">
    <div class="form-group col-lg-12">
        <div class="i-checks">
            <label>
                <input type="checkbox"
                       class="filter-checkbox"
                       id="filter-my-calendars"
                       data-role="i-check"
                >
                Only my calendars
            </label>
        </div>
    </div>
    <div class="form-group col-lg-12">
        <label class="control-label small">Selected calendars</label>
        {!! Form::select('filter_calendars', ['all' => 'All'],
        0,
        ['id' => 'filter-by-calendars', 'class' => 'form-control full-width']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-4 no-margins">
        <button type="button" class="btn btn-outline btn-default hidden" id="reset-filter">
            <i class="fa fa-undo"></i>&nbsp;Reset filters
        </button>
    </div>
</div>