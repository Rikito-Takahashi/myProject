@extends('layouts.Contents_layout')

@section('main')

<div class="container py-4">

{{-- 検索フォームここから --}}
<div class="d-flex justify-content-center mb-4">
    <form action="{{ route('post_search') }}" method="GET" class="d-flex " style="width: 300px;">
        <input type="text" name="tag" class="form-control" placeholder="タグで検索">
        <button type="submit" class="btn btn-primary ms-2" style="white-space: nowrap;">検索</button>
    </form>
</div>    
{{-- 検索フォームここまで --}}

<a href="{{ route('logout') }}"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    ログアウト
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

{{-- フォローユーザーの投稿新着順表示領域ここから --}}
<h3>あなたへの新着</h3>

@if($followPosts->isEmpty())
    <p>フォロー中のユーザーの投稿はまだありません。</p>
@else
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
    @foreach($followPosts as $post)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm">

                {{-- 投稿画像 --}}
                @if($post->post_image)
                    @if(Auth::id() === $post->user->id)
                        {{-- 自分の投稿ならマイページ内詳細ページへ --}}
                        <a href="{{ route('mypost_detail', ['id' => $post->id]) }}">
                            <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" class="card-img-top" style="aspect-ratio: 1 / 1; object-fit: cover;">
                        </a>
                    @else
                        {{-- 他人の投稿なら通常の詳細ページへ --}}
                        <a href="{{ route('post_detail', ['id' => $post->id]) }}">
                            <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" class="card-img-top" style="aspect-ratio: 1 / 1; object-fit: cover;">
                        </a>
                    @endif

                    {{-- 作品情報 --}}
                    <p class="card-title mb-1 text-truncate">{{ $post->title }}</p>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('user_page', ['id' => $post->user->id]) }}">
                            <img src="{{ asset('storage/' . $post->user->icon_img) }}" alt="アイコン" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                        </a>
                        <span>{{ $post->user->name }}</span>
                    </div>
                @endif
            </div>    
        </div>
    @endforeach
    </div>
@endif
{{-- フォローユーザーの投稿新着順表示領域ここまで --}}

</div>

@endsection