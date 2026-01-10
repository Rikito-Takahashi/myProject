<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link href = " https://unpkg.com/sanitize.css " rel = " stylesheet " />
    
</head>
<body>
    <header class="d-flex justify-content-between align-items-center px-4 py-2 bg-dark text-white">
    <a href="{{ route('main') }}" class="text-decoration-none"><h3 class="m-0">ArtMuch</h3></a>
    
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('create_post')}}" class="btn btn-outline-Success btn-sm">投稿する</a>
        <div>
            <a href="{{ route('mypage') }}">          
            @if(Auth::user()->icon_img)
                <img src="{{ asset('storage/' . Auth::user()->icon_img) }}" alt="アイコン" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
            @else
                <span>{{ Auth::user()->name }}</span>
            @endif
            </a>
        </div>
    

    <a href="{{ route('logout') }}" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline-danger btn-sm">
        ログアウト
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    </div>

    </header>
</body>
</html>