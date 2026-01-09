@extends('layouts.Contents_layout')

@section('post_search')

{{-- 検索フォームここから --}}
<form action="{{ route('post_search') }}" method="GET">
    <input type="text" name="tag" placeholder="タグで検索">
    <button type="submit">検索</button>
</form>
{{-- 検索フォームここまで --}}

{{-- 検索結果表示領域ここから --}}
@if(isset($tag_name))
    <h3>「{{ $tag_name }}」タグを持つ作品</h3>

    @if($posts->isEmpty())
        <p>「{{ $tag_name }}」タグを持つ作品は見つかりませんでした。</p>
    @else
        @foreach($posts as $post)
            <div>
                @if($post->post_image)
                    @if(Auth::id() === $post->user->id)
                    {{-- 自分の投稿なら自身の作品詳細ページへ --}}
                    <a href="{{ route('mypost_detail', ['id' => $post->id]) }}">
                        <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" width="200">
                    </a>
                    @else
                    {{-- 他人の投稿なら通常の作品詳細ページへ --}}
                    <a href="{{ route('post_detail', ['id' => $post->id]) }}">
                        <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" width="200">
                    </a>
                @endif
                @endif
                <p>{{ $post->title }}</p>
                {{-- ↓作品タイトル下に投稿ユーザーのアイコン/アカウント名表示↓ --}}
                @if($post->user)
                <div>
                    @if(Auth::id() === $post->user->id)
                    {{-- 自分自身ならマイページへ --}}
                    <a href="{{ route('mypage') }}">
                        <img src="{{ asset('storage/' . $post->user->icon_img) }}" alt="アイコン" style="width: 30px;">
                    </a>
                    <span>{{ $post->user->name }}</span>
                    @else
                    {{-- 他人ならそのユーザーのマイページへ --}}
                    <a href="{{ route('user_page', ['id' => $post->user->id]) }}">
                        <img src="{{ asset('storage/' . $post->user->icon_img) }}" alt="アイコン" style="width: 30px;">
                    </a>
                    <span>{{ $post->user->name }}</span>
                </div>    
                    @endif
                @endif    
            </div>
        @endforeach
    @endif
@endif
{{-- 検索結果表示領域ここまで --}}

@endsection