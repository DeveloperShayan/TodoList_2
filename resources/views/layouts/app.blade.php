<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{  asset('css/app.css')  }}">
</head>
<body>
    <div class="row px-0 mx-0">
        <div class="col-sm-12 bg-black text-white text-center">
            <h1>Todo List With Vue and Laravel</h1>
        </div>
    </div>
    <div class="m-1 p-1"></div>
    <center>
    <div id="app">
        @yield('content')
    </div>
    </center>
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
