@extends('layouts.Contents_layout')

@section('post_search')

<div class="container py-4">

{{-- 検索フォームここから --}}
<div class="d-flex justify-content-center mb-4">
    <form action="{{ route('post_search') }}" method="GET" class="d-flex " style="width: 300px;">
        <input type="text" name="tag" class="form-control" placeholder="タグで検索">
        <button type="submit" class="btn btn-primary ms-2" style="white-space: nowrap;">検索</button>
    </form>
</div> 
{{-- 検索フォームここまで --}}

{{-- 検索結果表示領域ここから --}}
@if(isset($tag_name))
    <h3>「{{ $tag_name }}」タグを持つ作品</h3>

    @if($posts->isEmpty())
        <p>「{{ $tag_name }}」タグを持つ作品は見つかりませんでした。</p>
    @else

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
        @foreach($posts as $post)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    @if($post->post_image)
                        @if(Auth::id() === $post->user->id)
                        {{-- 自分の投稿なら自身の作品詳細ページへ --}}
                        <a href="{{ route('mypost_detail', ['id' => $post->id]) }}">
                            <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" class="card-img-top" style="aspect-ratio: 1 / 1; object-fit: cover;">
                        </a>
                        @else
                        {{-- 他人の投稿なら通常の作品詳細ページへ --}}
                        <a href="{{ route('post_detail', ['id' => $post->id]) }}">
                            <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" class="card-img-top" style="aspect-ratio: 1 / 1; object-fit: cover;">
                        </a>
                        @endif
                    @endif
                    <p class="card-title mb-1 text-truncate">{{ $post->title }}</p>
                    {{-- ↓作品タイトル下に投稿ユーザーのアイコン/アカウント名表示↓ --}}
                    <div class="d-flex align-items-center">
                        @if($post->user)
                            @if(Auth::id() === $post->user->id)
                            {{-- 自分自身ならマイページへ --}}
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('mypage') }}">
                                        <img src="{{ asset('storage/' . $post->user->icon_img) }}" alt="アイコン" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                    </a>
                                    <span>{{ $post->user->name }}</span>
                                </div>
                            @else
                            {{-- 他人ならそのユーザーのマイページへ --}}
                            <div class="d-flex align-items-center">
                                <a href="{{ route('user_page', ['id' => $post->user->id]) }}">
                                    <img src="{{ asset('storage/' . $post->user->icon_img) }}" alt="アイコン" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                </a>
                                <span>{{ $post->user->name }}</span> 
                            </div>   
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>    
@endif
</div>
{{-- 検索結果表示領域ここまで --}}

</div>
</div>
@endsection