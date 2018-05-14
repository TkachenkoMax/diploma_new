<div class="ibox-content no-borders">
    <div class="row">
        <div class="form-group col-md-2">
            <label class="control-label small">Role</label>
            {!! Form::select('filter_role', ['all' => 'All'] + array_get($data, 'roles', []),
            0,
            ['id' => 'filter-by-role', 'class' => 'form-control full-width']) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
        <div class="form-group col-md-2">
            <label class="control-label small">Name</label>
            <input name="filter_name" type="text" class="form-control" id="filter-by-name" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4 no-margins">
            <button type="button" class="btn btn-outline btn-default hidden" id="reset-filter">
                <i class="fa fa-undo"></i>&nbsp;Reset filters
            </button>
        </div>
    </div>
</div>