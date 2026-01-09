@extends('layouts.Contents_layout')

@section('user_page')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@if($user->header_img)
    <img src="{{ asset('storage/' . $user->header_img) }}" alt="ヘッダー画像" style="width: 100%;>
@endif

<div>
    @if($user->icon_img)
    <img src="{{ asset('storage/' . $user->icon_img) }}" alt="ユーザーアイコン">
    @endif
    <p>{{ $user->name }}</p>
    <p>{{ $user->profile }}</p>
</div>

{{-- フォロー・フォロー解除ボタン --}}
@if(Auth::check() && Auth::id() !== $user->id)
    <button class="follow-button" data-follow-id="{{ $user->id }}">
        {{ Auth::user()->isFollowing($user->id) ? 'フォロー解除' : 'フォローする' }}
    </button>
@endif

<h4>投稿作品</h4>
<ul class="d-flex">
    <li>ホーム</li>
    <li>イラスト</li>
    <li>マンガ</li>
</ul>

{{-- 投稿作品表示領域ここから --}}
    @if(count($posts) > 0)
        <div>
            @foreach($posts as $post)
            {{-- サムネ押下したら作品詳細画面へ遷移 --}}
            <a href="{{ route('post_detail', ['id' => $post->id]) }}">
                <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" style="max-width: 300px;">    
            </a>    
            <p>{{ $post->title }}</p>
            @endforeach
        </div>
        @else
        <p>投稿はまだありません。</p>
        @endif
{{-- 投稿作品表示領域ここまで --}}

{{-- <script src="{{ mix('js/app.js') }}"></script> --}}


</body>
@endsection