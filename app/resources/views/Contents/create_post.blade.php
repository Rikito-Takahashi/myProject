@extends('layouts.Contents_layout')

@section('create_post')

<form action="{{ route('create_post')}}" enctype="multipart/form-data" method="post">
    @csrf

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div>
    <label for='img'>画像を追加</label><br>
    <input type="file" name="img_path">
    </div>

    <h3>作品詳細</h3>

    <div>
    <label for='title'>作品タイトル</label><br>
    <input type="text" name="title" id="title"/>
    </div>

    <div>
    <label for='caption'>キャプション</label><br>
    <input type="text" name="caption" id="caption"/>
    </div>

    <div>
    <label for='post_type'>作品タイプ</label><br>
    <input type="radio" name="post_type" id="post_type" value="0"/>イラスト
    <input type="radio" name="post_type" id="post_type" value="1"/>マンガ
    {{-- DBのテーブル上で0=イラスト/1=マンガとして識別してる為、value=""もそれぞれの数値に --}}
    </div>

    <div>
    <label for='tag_name'>タグ</label><br>
    <input type="text" name="tag_name" id="tag_name"/>
    </div>

    <input type="submit" value="投稿する">
</form>

@endsection