<div class="row">
    <div class="form-group col-md-4">
        <label class="control-label small">Calendar name</label>
        <input name="filter_name" type="text" class="form-control" id="filter-by-name" />
    </div>
    <div class="form-group col-md-4 col-xs-6">
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
    <div class="form-group col-md-4 col-xs-6">
        <div class="i-checks">
            <label>
                <input type="checkbox"
                       class="filter-checkbox"
                       id="filter-public-calendars"
                       data-role="i-check"
                >
                Only public calendars
            </label>
        </div>
    </div>
    <div class="form-group col-md-4 col-xs-6">
        <div class="i-checks">
            <label>
                <input type="checkbox"
                       class="filter-checkbox"
                       id="filter-editable-calendars"
                       data-role="i-check"
                >
                I can edit
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-4 no-margins">
        <button type="button" class="btn btn-outline btn-default hidden" id="reset-filter">
            <i class="fa fa-undo"></i>&nbsp;Reset filters
        </button>
    </div>
</div>