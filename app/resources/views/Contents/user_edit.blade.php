@extends('layouts.Contents_layout')

@section('user_edit')

<h3>アカウント情報編集</h3>

{{-- ヘッダー画像/アイコン編集フォームここから --}}
<h5>ヘッダー画像/アイコン</h5>

<form action="{{ route('user_img_edit' )}}" method="POST" enctype="multipart/form-data">
    @csrf

        <div>
        <label for='img'>ヘッダー画像を変更する</label><br>
        <input type="file" name="header_img">
    </div>

    <div>
        <label for='img'>アイコン画像を変更する</label><br>
        <input type="file" name="icon_img">
    </div>

    <button type="submit" >画像を保存</button>

</form>
{{-- ヘッダー画像/アイコン編集フォームここまで --}}

{{-- ユーザ情報編集フォームここから --}}
<h5>ユーザー情報</h5>

<form action="{{ route('user_edit_conf') }}" method="POST">
    @csrf

    <div>
        <label>ユーザー名</label><br>
        <input type="text" id="name" name="name" value="{{ $user->name }}">
    </div>

    <div>
        <label>メールアドレス</label><br>
        <input type="email" id="email" name="email" value="{{ $user->email }}">
    </div>

    <div>
        <label>パスワード</label><br>
        <input type="password" id="password" name="password">
    </div>

    <div>
        <label>パスワード確認</label><br>
        <input type="password" id="password_conf" name="password_conf">
    </div>

    <div>
        <label>プロフィール</label><br>
        <textarea name="profile">{{ $user->profile }}</textarea>
    </div>

    <button type="submit" >編集内容確認</button>

</form>
{{-- ユーザ情報編集フォームここまで --}}

<form action="{{ route('user_delete_conf') }}" method="get">
    <button type="submit">アカウントを削除する</button>
</form>

<a href="{{ route('mypage') }}">マイページへ戻る</a>

@endsection