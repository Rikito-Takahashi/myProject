@extends('layouts.Contents_layout')

@section('user_edit')

<h3>アカウント情報編集</h3>
<form action="" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for='img'>ヘッダー画像を変更する</label><br>
        <input type="file" name="header_img">
    </div>

    <div>
        <label for='img'>アイコン画像を変更する</label><br>
        <input type="file" name="icon_img">
    </div>

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
        <input type="password" id="password" name="password" value="{{ $user->password }}">
    </div>

    <div>
        <label>パスワード確認</label><br>
        <input type="password" id="password_conf" name="password_conf" value="{{ $user->password }}">
    </div>

    <div>
        <label>プロフィール</label><br>
        <textarea name="profile">{{ $user->profile }}</textarea>
    </div>

    <button type="submit" >編集内容確認</button>

</form>    

@endsection