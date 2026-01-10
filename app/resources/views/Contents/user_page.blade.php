@extends('layouts.Contents_layout')

@section('user_page')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

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
                <p>{{ $user->name }}</p>
                <p>{{ $user->profile }}</p>
            </div>
        </div>
        {{-- フォロー・フォロー解除ボタン --}}
        <div class="mt-3 mt-md-0">
            @if(Auth::check() && Auth::id() !== $user->id)
                <button class="follow-button btn btn-Success btn-sm mt-2 px-4 py-2 fs-5"  data-follow-id="{{ $user->id }}">
                {{ Auth::user()->isFollowing($user->id) ? 'フォロー解除' : 'フォローする' }}
                </button>
            @endif
        </div>
    </div>            
</div>

{{-- フォロー・フォロー解除ボタン --}}
{{-- @if(Auth::check() && Auth::id() !== $user->id)
    <button class="follow-button" data-follow-id="{{ $user->id }}">
        {{ Auth::user()->isFollowing($user->id) ? 'フォロー解除' : 'フォローする' }}
    </button>
@endif --}}

<h4>投稿作品</h4>
{{-- <ul class="d-flex">
    <li>ホーム</li>
    <li>イラスト</li>
    <li>マンガ</li>
</ul> --}}

{{-- 投稿作品表示領域ここから --}}
    @if(count($posts) > 0)
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
            @foreach($posts as $post)
            <div class="col">
                <div class="card h-100">
                    {{-- サムネ押下したら作品詳細画面へ遷移 --}}
                    <a href="{{ route('post_detail', ['id' => $post->id]) }}">
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