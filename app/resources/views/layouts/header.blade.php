<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link href = " https://unpkg.com/sanitize.css " rel = " stylesheet " />
    
</head>
<body>
    <header class="d-flex justify-content-around mt-3">
    <a href="{{ route('main') }}"><h3>ArtMuch</h3></a>
    <ul class="navi d-flex justify-content-around mt-3">
        <a href="{{ route('create_post')}}"><li>投稿する</li></a>
        <a href="{{ route('mypage')}}"><li>{{ Auth::user()->name }}</li></a>
        <a href="{{ route('logout') }}" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <li>ログアウト</li>
        </a>
    </ul>
    </header>
</body>
</html>