@extends('layouts.Contents_layout')

@section('mypage')

<body>

    {{-- アカウント情報編集完了後リダイレクト時メッセージ表示関連ここから --}}
@if(session('success'))
    <div class="popup-message">
        <h4>{{ session('success') }}</h4>
    </div>
@endif

<script>
    setTimeout(() => {
        const popup = document.querySelector('.popup-message');
        if (popup) popup.style.display = 'none';
    }, 3000); // 3秒で非表示
</script>
{{-- アカウント情報編集完了後リダイレクト時メッセージ表示関連ここから --}}


@if($user->header_img)
    <img src="{{ asset('storage/' . $user->header_img) }}" alt="ヘッダー画像" class="img-fluid w-100 mb-3" style="object-fit: cover; height: 300px;">
@endif

<div class="container py-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-start flex-wrap">
        <div class="d-flex align-items-center mb-4">
            @if($user->icon_img)
                <img src="{{ asset('storage/' . $user->icon_img) }}" alt="ユーザーアイコン" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
            @endif
            <div class="ms-4">
                <p>{{ Auth::user()->name }}</p>
                {{-- <p class="mb-1">フォロー中　　</p> --}}
                <p>{{ Auth::user()->profile }}</p>

            </div>     
        </div>
        <div class="mt-3 mt-md-0"> 
            <a href="{{ route('user_edit') }}" class="btn btn-outline-Success btn-sm mt-2 px-4 py-2 fs-5">プロフィールを編集</a>
        </div>
    </div>    
</div>

{{-- <div>
    <a href="{{ route('user_edit') }}" class="btn btn-outline-secondary btn-sm mt-2">プロフィールを編集</a>
</div> --}}

<h4>投稿作品</h4>
{{-- <ul class="nav nav-tabs mb-4">
    <li>ホーム</li>
    <li>イラスト</li>
    <li>マンガ</li>
    <li>Like!</li>
</ul> --}}

{{-- 投稿作品表示領域ここから --}}
    @if(count($posts) > 0)
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
            @foreach($posts as $post)
            <div class="col">
                <div class="card h-100">
                    {{-- サムネ押下したら作品詳細画面へ遷移 --}}
                    <a href="{{ route('mypost_detail', ['id' => $post->id]) }}">
                        <img src="{{ asset('storage/' . $post->post_image->img_path) }}" class="card-img-top" alt="投稿画像" style="object-fit: cover; height: 150px;">
                    </a>
                    <div class="card-body p-2">
                        <p class="card-text text-center small">{{ $post->title }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p>投稿はまだありません。</p>
        @endif
{{-- 投稿作品表示領域ここまで --}}

</div>

</body>
@endsection