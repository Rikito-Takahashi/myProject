<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '家計簿') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

@include('layouts.header')

    <main>
        
        @yield('main')
        @yield('create_post')
        @yield('mypage')
        @yield('user_edit')
        @yield('user_edit_conf')
        @yield('user_delete_conf')
        @yield('post_search')
        @yield('user_page')
        @yield('post_detail')
        @yield('mypost_detail')
        @yield('mypost_edit')

    </main>

    <script src="{{ mix('js/app.js') }}"></script>
</body>    

</html>