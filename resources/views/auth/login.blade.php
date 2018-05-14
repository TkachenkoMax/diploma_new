@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">AoT</h1>
            </div>
            <h3>Welcome to "Ahead of time" Organizer</h3>
            <p>Perfectly designed organizer application where you can manage your calendars and events on it, share it with your contacts and interact with to-do list.</p>
            <hr/>
            {!! Form::open(array('url' => '/login', 'class' => 'm-t')) !!}
                <div class="form-group">
                    {!! Form::text('email' , null, ["placeholder" => "E-mail", "class" => "form-control", "required" => "true"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password', ["placeholder" => "Password", "class" => "form-control", "required" => "true"]) !!}
                </div>
                {!! Form::submit('Login', ["class" => "btn btn-primary block full-width m-b"]) !!}
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="/register">Create an account</a>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
