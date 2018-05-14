@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">AoT</h1>
            </div>
            <h3>Register to "Ahead of Time" Organizer</h3>
            <p>Create account to start use the application.</p>
            {!! Form::open(array('url' => '/register', 'class' => 'm-t', 'method' => 'post')) !!}
                <div class="form-group">
                    {!! Form::text('firstname' , null, ["placeholder" => "Firstname", "class" => "form-control", "required" => "true"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('lastname' , null, ["placeholder" => "Lastname", "class" => "form-control", "required" => "true"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('email' , null, ["placeholder" => "E-mail", "class" => "form-control", "required" => "true"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password', ["placeholder" => "Password", "class" => "form-control", "required" => "true"]) !!}
                </div>
                <div class="form-group">
                    <div class="i-checks">
                        <label>
                            <input type="checkbox"
                                   class="filter-checkbox"
                                   id="agree"
                                   name="agree"
                                   data-role="i-check"
                            >
                            Agree the terms and policy
                        </label>
                    </div>
                </div>
                {!! Form::submit('Register', ["class" => "btn btn-primary block full-width m-b"]) !!}
                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="/login">Login</a>
            {!! Form::close() !!}
        </div>
    </div>
@endsection