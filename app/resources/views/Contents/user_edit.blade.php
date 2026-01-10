@extends('layouts.Contents_layout')

@section('user_edit')

<div class="container mt-5" style="max-width: 500px;">

<h3 class="text-center mb-4">アカウント情報編集</h3>

{{-- ヘッダー画像/アイコン編集フォームここから --}}
<h5 class="text-center mb-4">ヘッダー画像/アイコン</h5>

<form action="{{ route('user_img_edit' )}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for='img'>ヘッダー画像を変更する</label><br>
        <input type="file" name="header_img">
    </div>

    <div class="mb-3">
        <label for='img'>アイコン画像を変更する</label><br>
        <input type="file" name="icon_img">
    </div>

    <button type="submit" class="btn btn-primary w-100" >画像を保存</button>

</form>
{{-- ヘッダー画像/アイコン編集フォームここまで --}}

<br>
<br>

{{-- ユーザ情報編集フォームここから --}}
<h5 class="text-center mb-4">ユーザー情報</h5>

<form action="{{ route('user_edit_conf') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>ユーザー名</label><br>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>

    <div class="mb-3">
        <label>メールアドレス</label><br>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
    </div>

    <div class="mb-3">
        <label>パスワード</label><br>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="mb-3">
        <label>パスワード確認</label><br>
        <input type="password" class="form-control" id="password_conf" name="password_conf">
    </div>

    <div class="mb-3">
        <label>プロフィール</label><br>
        <textarea class="form-control" name="profile">{{ $user->profile }}</textarea>
    </div>

    <br>
    <button type="submit" class="btn btn-primary w-100">編集内容確認</button>

</form>
{{-- ユーザ情報編集フォームここまで --}}

<form action="{{ route('user_delete_conf') }}" method="get">
    <button type="submit" class="btn btn-Danger w-100">アカウントを削除する</button>
</form>

<div class="text-center">
    <a href="{{ route('mypage') }}">マイページへ戻る</a>
</div>    

@endsection