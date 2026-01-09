<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '家計簿') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

    <header class="d-flex justify-content-around mt-3">
    <a href="{{ route('admin.dashboard') }}">仮ロゴ</a>
    <ul class="navi d-flex justify-content-around mt-3">
        <a href="{{ route('create_post')}}"><li>投稿する</li></a>
        <a href="{{ route('mypage')}}"><li>{{ Auth::user()->name }}</li></a>
        <a href="{{ route('logout') }}" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        ログアウト
        </a>
    </ul>
    </header>

    <main>
        @yield('kanrisya')
        @yield('kanrisya_user')
        @yield('kanrisya_post')
    </main>
</html>