@extends('layouts.Contents_layout')

@section('mypost_edit')

<form action="{{ route('mypost_update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($post->post_image)
        <div>
            <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" width="200">
        </div>
    @endif
    <input type="file" name="image">

    <div>
        <label>タイトル</label><br>
        <input type="text" name="title" value="{{ $post->title }}">
    </div>

    <div>
        <label>キャプション</label><br>
        <textarea name="caption">{{ $post->caption }}</textarea>
    </div>

    <div>
        <label>作品タイプ</label><br>
        <input type="radio" name="post_type" value="0" {{ $post->post_type == 0 ? 'checked' : '' }}> イラスト
        <input type="radio" name="post_type" value="1" {{ $post->post_type == 1 ? 'checked' : '' }}> マンガ
    </div>

    <div>
        <label>タグ</label><br>
        <input type="text" name="tag_name" value="{{ $post->tags->first()->tag_name ?? '' }}">
    </div>


    <button type="submit">更新する</button><br>
</form>
{{-- 投稿削除ボタンここから --}}
<form id="delete-form" action="{{ route('mypost_delete', ['id' => $post->id]) }}" method="POST" style="display: inline;">
    @csrf
    <button type="button" onclick="confirmDelete()">投稿を削除する</button>
</form>

<script>
    function confirmDelete() {
        if (confirm('本当に削除しますか？')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
{{-- 投稿削除ボタンここまで --}}


@endsection