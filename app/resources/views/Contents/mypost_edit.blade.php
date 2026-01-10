@extends('layouts.Contents_layout')

@section('mypost_edit')

<div class="container mt-5" style="max-width: 400px;">

<form action="{{ route('mypost_update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <h3 class="text-center mb-4">作品を編集する</h3>

    <br>
    
    @if($post->post_image)
        <div class="text-center">
            <img src="{{ asset('storage/' . $post->post_image->img_path) }}" alt="投稿画像" width="200">
        </div>
    @endif

    <div class="text-center">
        <h5 class="text-center mb-4">画像を編集</h5>
        <input type="file" name="image">
    </div>
    
    <br>
    <br>

    <div class="mb-3">
        <label>作品タイトル</label><br>
        <input type="text" class="form-control" name="title" value="{{ $post->title }}">
    </div>

    <div class="mb-3">
        <label>キャプション</label><br>
        <textarea class="form-control" name="caption">{{ $post->caption }}</textarea>
    </div>

    <div class="mb-3">
        <label>作品タイプ</label><br>
        <div class="text-center d-flex justify-content-around">
            <div>    
                <input type="radio" name="post_type" value="0" {{ $post->post_type == 0 ? 'checked' : '' }}> イラスト
            </div>
            <div>    
                <input type="radio" name="post_type" value="1" {{ $post->post_type == 1 ? 'checked' : '' }}> マンガ
            </div>
        </div>
    </div>    

    <div class="mb-3">
        <label>タグ</label><br>
        <input type="text" class="form-control" name="tag_name" value="{{ $post->tags->first()->tag_name ?? '' }}">
    </div>

    <br>

    <button type="submit" class="btn btn-primary w-100">更新する</button><br>
</form>
{{-- 投稿削除ボタンここから --}}
<form id="delete-form" action="{{ route('mypost_delete', ['id' => $post->id]) }}" method="POST" style="display: inline;">
    @csrf
    <button type="button" class="btn btn-Danger w-100" onclick="confirmDelete()">投稿を削除する</button>
</form>

<br>
<br>

<script>
    function confirmDelete() {
        if (confirm('本当に削除しますか？')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
{{-- 投稿削除ボタンここまで --}}

</div>

@endsection