@extends('layouts.Contents_layout')

@section('mypage')

<div>
    <p>{{ Auth::user()->name }}</p>
    <p>フォロー中　　フォロワー　　</p>
    <P>プロフィール文</P>
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
                <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" style="max-width: 300px;">    
                <p>{{ $post->title }}</p>
            @endforeach
        </div>
        @else
        <p>投稿はまだありません。</p>
        @endif
{{-- 投稿作品表示領域ここまで --}}

@endsection