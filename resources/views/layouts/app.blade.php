<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>@yield('title') | Ahead of Time</title>

    <link rel="icon" type="image/png" href="/fav-png.png">

    <link rel="stylesheet" href="{!! mix('css/vendor.css') !!}"/>
    <link rel="stylesheet" href="{!! mix('css/app.css') !!}"/>

</head>
<body class="top-navigation">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">

            <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Main view  -->
        @yield('content')

        <!-- Footer -->
        @include('layouts.footer')

        </div>
        <script src="{!! mix('js/manifest.js') !!}" type="text/javascript"></script>
        <script src="{!! mix('js/vendor.js') !!}" type="text/javascript"></script>
        <script src="{!! mix('js/app.js') !!}" type="text/javascript"></script>
        <script src="{!! mix('js/organizer.js') !!}"></script>
        @section('scripts')
        @show
    </div>
</body>
</html>
