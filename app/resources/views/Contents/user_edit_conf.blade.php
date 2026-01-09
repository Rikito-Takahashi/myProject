@extends('layouts.Contents_layout')

@section('user_edit_conf')

<h3>アカウント情報編集</h3>
<form action="{{ route('user_edit') }}" method="POST">
    @csrf

    <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="password" value="{{ $password }}">
    <input type="hidden" name="profile" value="{{ $profile }}">

    <h4>この内容で更新します。よろしいですか？</h4>

    <div>
        <label>ユーザー名</label><br>
        <P>{{ $name }}</P>
    </div>

    <div>
        <label>メールアドレス</label><br>
        <p>{{ $email }}</p>
    </div>

    <div>
        <label>パスワード</label><br>
        <p>{{ $password }}</p>
    </div>

    <div>
        <label>プロフィール</label><br>
        <p>{{ $profile }}</p>
    </div>

    <button type="submit" >プロフィール更新</button>
    

</form> 

@endsection