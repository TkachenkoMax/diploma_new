{!! Form::open(array('url' => '/settings/change-information', 'class' => 'm-t', 'style' => 'padding-right: 10px;')) !!}

<div class="form-group row m-b-md">
    {!! Form::label('firstname' , 'Firstname', ["class" => "col-sm-2 col-form-label label-right"]) !!}
    <div class="col-sm-4">
        {!! Form::text('firstname' , $user->firstname, ["placeholder" => "", "class" => "form-control", "id" => "firstname"]) !!}
    </div>
    {!! Form::label('lastname' , 'Lastname', ["class" => "col-sm-2 col-form-label label-right"]) !!}
    <div class="col-sm-4">
        {!! Form::text('lastname' , $user->lastname, ["placeholder" => "", "class" => "form-control", "id" => "lastname"]) !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('date_of_birth' , 'Date of birth', ["class" => "col-sm-2 col-form-label label-right"]) !!}
    <div class="col-sm-4">
        {!! Form::text('date_of_birth' , $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') : null, ["placeholder" => "", "class" => "form-control", "id" => "date_of_birth", "data-mask" => "99/99/9999"]) !!}
        <span class="help-block">dd/mm/yyyy</span>
    </div>
    {!! Form::label('sex' , 'Sex', ["class" => "col-sm-2 col-form-label label-right"]) !!}
    <div class="col-sm-4">
        {!! Form::select('sex', [null => 'Not specified', '0' => 'Male', '1' => 'Female'], $user->sex, ["class" => "custom-select"]); !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('phone_number' , 'Phone Number', ["class" => "col-sm-2 col-form-label label-right"]) !!}
    <div class="col-sm-4">
        {!! Form::text('phone_number' , $user->phone_number ?: null, ["placeholder" => "", "class" => "form-control", "id" => "phone_number", "data-mask" => "(999)-999-99-99"]) !!}
        <span class="help-block">(0xx)-xxx-xx-xx</span>
    </div>
    {!! Form::label('address' , 'Address', ["class" => "col-sm-2 col-form-label label-right"]) !!}
    <div class="col-sm-4">
        {!! Form::text('address' , $user->address ?: null, ["placeholder" => "", "class" => "form-control", "id" => "address"]) !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('work_place' , 'Work place', ["class" => "col-sm-2 col-form-label label-right"]) !!}
    <div class="col-sm-4">
        {!! Form::text('work_place' , $user->work_place ?: null, ["placeholder" => "", "class" => "form-control", "id" => "work_place"]) !!}
    </div>
    {!! Form::label('work_position' , 'Work Position', ["class" => "col-sm-2 col-form-label label-right"]) !!}
    <div class="col-sm-4">
        {!! Form::text('work_position' , $user->work_position ?: null, ["placeholder" => "", "class" => "form-control", "id" => "work_position"]) !!}
    </div>
</div>

<div class="form-group row">
    <div class="col-md-offset-5 col-md-2">
        {!! Form::submit('Save', ['class' => 'btn btn-success block full-width m-b m-t']) !!}
    </div>
</div>

{!! Form::close() !!}