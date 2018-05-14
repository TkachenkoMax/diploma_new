@extends('layouts.app')

@section('title', 'Error')

@section('content')
    <div class="middle-box text-center animated fadeInDown">
        @switch(session('code'))
            @case(403)
                <h1>403</h1>
                <h3 class="font-bold">Access denied</h3>
                <div class="error-desc">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @break

            @case(500)
                <h1>500</h1>
                <h3 class="font-bold">Internal Server Error</h3>
                <div class="error-desc">
                    Please return to the home page and try again
                </div>
            @break

            @default
                <h1>Error</h1>
                <h3 class="font-bold">Something went wrong</h3>
                <div class="error-desc">
                    Please return to the home page and try again
                </div>
        @endswitch
    </div>




@stop