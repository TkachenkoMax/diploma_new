{!! Form::open(['route' => isset($calendar) ? ['calendar.update', $calendar->id] : ['calendar.create'], 'id' => isset($calendar) ? 'edit-calendar' : 'create-calendar', 'class' => 'form-horizontal', 'method' => isset($calendar) ? 'PUT' : 'POST' ]) !!}

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-10">
                <div class="row">
                    <label class="col-sm-6" for="name">Calendar Name: </label>
                    <div class="col-sm-12">
                        {{ Form::input('text', 'name', isset($calendar) ? $calendar->name : '',
                        ['id' => 'name', 'class' => 'form-control input-altitude', 'required', 'maxlength' => 255])}}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-10">
                <div class="row">
                    <label class="col-sm-6" for="description">Description: </label>
                    <div class="col-sm-12">
                    <textarea name="description" id="description" class="form-control no-resize">{{isset($calendar) ? $calendar->description : ''}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group m-b-0">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="i-checks">
                            <label>
                                <input type="checkbox"
                                       name="is_public"
                                       class="is_public"
                                       id="is_public"
                                       data-role="i-check"
                                        {{isset($calendar->is_public) && $calendar->is_public ? 'checked value=1' : 'value=0'}}
                                >
                                Is public
                            </label>
                        </div>
                        <p class="text-muted"><small>You will not have opportunity to change it after create.</small></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="i-checks">
                            <label>
                                <input type="checkbox"
                                       name="is_editable"
                                       class="is_editable"
                                       id="is_editable"
                                       data-role="i-check"
                                        {{isset($calendar->is_editable) && $calendar->is_editable ? 'checked value=1' : 'value=0'}}
                                >
                                Is editable
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-10">
                <div class="row">
                    <label class="col-sm-6" for="edit_users">Assigned users: </label>
                    <div class="col-sm-12">
                        {!! Form::select('assigned_users', $users,
                         !empty($assignedUsers) ? $assignedUsers : '',
                         ['id' => 'assigned_users', 'class' => 'form-control full-width', 'multiple']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row-fluid">
        <div class="col-sm-4 col-sm-pull-0.5 pull-right">
            <button class="btn btn-primary" type="submit">Save</button>
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>

{!! Form::close() !!}