{!! Form::open(array('url' => '/settings/change-password', 'class' => 'm-t', 'style' => 'padding-right: 10px;')) !!}

    <div class="form-group row">
        <label class="col-sm-4 col-form-label label-right" for="current-password">Current password</label>
        <div class="col-md-8">
            <input id="current-password" name="current-password" type="password" placeholder="" class="form-control input-md" required="">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label label-right" for="new-password">New password</label>
        <div class="col-md-8">
            <input id="new-password" name="new-password" type="password" placeholder="" class="form-control input-md" required="">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-offset-5 col-md-2">
            {!! Form::submit('Change', ['class' => 'btn btn-success block full-width m-b']) !!}
        </div>
    </div>

{!! Form::close() !!}