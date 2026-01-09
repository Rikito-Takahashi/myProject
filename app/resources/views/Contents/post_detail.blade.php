@extends('layouts.Contents_layout')

@section('post_detail')

{{-- 投稿画像 --}}
<div class="d-flex">
    @if($post->post_image)
        <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" style="width: 50%;">
    @endif

    <div>
    {{-- 投稿者情報 --}}
    <div>
    <div style="display: flex; align-items: center; margin-top: 10px;">
        @if($post->user && $post->user->icon_img)
        <a href="{{ route('user_page', ['id' => $post->user->id]) }}">
            <img src="{{ asset('storage/' . $post->user->icon_img) }}" alt="ユーザーアイコン" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
        </a>
            @endif
        <div>
            <p>{{ $post->user->name }}</p>
        </div>
    </div>
        <a href="{{ route('user_page', ['id' => $post->user->id]) }}">
            <p>作品一覧へ</p>
        </a>    
    </div> 

    {{-- タイトル --}}
    <h2>{{ $post->title }}</h2>

    {{-- キャプション --}}
    <p style="margin-top: 20px;">{{ $post->caption }}</p>

    {{-- 作品タグ --}}
    <div>
        <p>この作品のタグ</p>
        @foreach($post->tags as $tag)
            ＃{{ $tag->tag_name }}
        @endforeach
    </div>

    </div>
</div>

@endsection