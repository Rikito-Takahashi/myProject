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
    <img src="{{ asset('storage/' . $user->header_img) }}" alt="ヘッダー画像" style="width: 100%;>
@endif

<div>
    @if($user->icon_img)
    <img src="{{ asset('storage/' . $user->icon_img) }}" alt="ユーザーアイコン">
    @endif
    <p>{{ Auth::user()->name }}</p>
    <p>フォロー中　　フォロワー　　</p>
    <p>{{ Auth::user()->profile }}</p>
</div>

<div>
    <a href="{{ route('user_edit') }}">プロフィールを編集</a>
</div>

<h4>投稿作品</h4>
<ul class="d-flex">
    <li>ホーム</li>
    <li>イラスト</li>
    <li>マンガ</li>
    <li>Like!</li>
</ul>

{{-- 投稿作品表示領域ここから --}}
    @if(count($posts) > 0)
        <div>
            @foreach($posts as $post)
            {{-- サムネ押下したら作品詳細画面へ遷移 --}}
            <a href="{{ route('mypost_detail', ['id' => $post->id]) }}">
                <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" style="max-width: 300px;">
            </a>
            <p>{{ $post->title }}</p>
            @endforeach
        </div>
        @else
        <p>投稿はまだありません。</p>
        @endif
{{-- 投稿作品表示領域ここまで --}}

</body>
@endsection