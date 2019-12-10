<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FrontDesk') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-4.3.1/css/bootstrap.min.css') }}">
</head>
<body>
    <div id="app">
       @include('nav')
        <main class="py-4">
         <div class="container">
         @yield('content')
         </div>
        </main>
    </div>
    <!-- <script src="{{ asset('assets/js/jquery-1.12.4.js') }}"></script>
  <script src="{{ asset('assets/css/bootstrap-4.3.1/js/bootstrap.min.js') }}"></script> -->
</body>
</html>
