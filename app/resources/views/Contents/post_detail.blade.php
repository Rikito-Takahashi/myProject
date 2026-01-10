@extends('layouts.Contents_layout')

@section('post_detail')

<div class="container my-4">

    <div class="row">
        {{-- 投稿画像 --}}
        <div class="col-md-7 mb-4">
            @if($post->post_image)
                <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" style="width: 50%;">
            @endif
        </div>

        <div class="col-md-5">
            {{-- 投稿者情報 --}}
            <div class="d-flex align-items-center mb-3">
                @if($post->user && $post->user->icon_img)
                    <a href="{{ route('user_page', ['id' => $post->user->id]) }}">
                        <img src="{{ asset('storage/' . $post->user->icon_img) }}" alt="ユーザーアイコン" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                    </a>
                @endif
                <div class="ms-3">
                    <p>{{ $post->user->name }}</p>
                
            </div>
        </div>

        <div class="mb-3">
            <a href="{{ route('user_page', ['id' => $post->user->id]) }}"  class="btn btn-outline-info btn-sm px-4 py-2 fs-5">
                作品一覧へ
            </a>
        </div>     

        {{-- タイトル --}}
        <h4 class="fw-bold">{{ $post->title }}</h4>

        {{-- キャプション --}}
        <p class="mt-3">{{ $post->caption }}</p>

        {{-- 作品タグ --}}
        <div class="mt-4">
            <h5>この作品のタグ</h5>
            @foreach($post->tags as $tag)
                <span class="badge bg-light text-dark border me-1">＃{{ $tag->tag_name }}</span>
            @endforeach
        </div>
    </div>

    </div>
</div>

@endsection