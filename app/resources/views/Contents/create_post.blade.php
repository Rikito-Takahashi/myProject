@extends('layouts.Contents_layout')

@section('create_post')

<div class="container mt-5" style="max-width: 400px;">

<form action="{{ route('create_post')}}" enctype="multipart/form-data" method="post">
    @csrf

    <h3 class="text-center mb-4">作品を投稿する</h3>

    <br>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="text-center">
    <h5 class="text-center mb-4">画像を追加</h5>
    <input type="file" name="img_path">
    </div>

    <br>
    <br>

    <h5 class="text-center mb-4">作品詳細</h5>

    <div class="mb-3">
    <label for='title'>作品タイトル</label><br>
    <input type="text" class="form-control" name="title" id="title"/>
    </div>

    <div class="mb-3">
    <label for='caption'>キャプション</label><br>
    <textarea class="form-control" name="caption" id="caption"></textarea>
    </div>

    <div class="mb-3">
    <label for='post_type'>作品タイプ</label><br>
        <div class="text-center d-flex justify-content-around">
            <div>
                <input type="radio" name="post_type" id="post_type" class="mt-2" value="0"/>イラスト
            </div>
            <div>    
                <input type="radio" name="post_type" id="post_type" class="mt-2" value="1"/>マンガ
            </div>
            {{-- DBのテーブル上で0=イラスト/1=マンガとして識別してる為、value=""もそれぞれの数値に --}}
        </div>
    </div>

    <div class="mb-3">
        <label for='tag_name'>タグ</label><br>
        <input type="text" class="form-control" name="tag_name" id="tag_name"/>
    </div>

    <br>

    <input type="submit" class="btn btn-primary w-100" value="投稿する">
</form>

<div class="text-center">
    <a href="{{ route('mypage') }}">
        マイページへ
    </a>
</div> 

<br>
<br>

</div>

@endsection