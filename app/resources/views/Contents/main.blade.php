@extends('layouts.Contents_layout')

@section('main')

{{-- 検索フォームここから --}}
<form action="{{ route('post_search') }}" method="GET">
    <input type="text" name="tag" placeholder="タグで検索">
    <button type="submit">検索</button>
</form>
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
    <div class="d-flex">
    @foreach($followPosts as $post)
        <div class="post-card">
            @if($post->post_image)
                @if(Auth::id() === $post->user->id)
                    {{-- 自分の投稿ならマイページ内詳細ページへ --}}
                    <a href="{{ route('mypost_detail', ['id' => $post->id]) }}">
                        <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" width="200">
                    </a>
                @else
                    {{-- 他人の投稿なら通常の詳細ページへ --}}
                    <a href="{{ route('post_detail', ['id' => $post->id]) }}">
                        <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" width="200">
                    </a>
                @endif
                <p>{{ $post->title }}</p>
                <a href="{{ route('user_page', ['id' => $post->user->id]) }}">
                    <img src="{{ asset('storage/' . $post->user->icon_img) }}" alt="アイコン" style="width: 30px;">
                </a>
                <span>{{ $post->user->name }}</span>
            @endif
        </div>
    @endforeach
    </div>
@endif
{{-- フォローユーザーの投稿新着順表示領域ここまで --}}

@endsection