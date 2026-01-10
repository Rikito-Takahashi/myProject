@extends('layouts.Contents_layout')

@section('user_edit_conf')

<div class="container mt-5" style="max-width: 500px;">

<h3 class="text-center mb-4">アカウント情報編集</h3>
<form action="{{ route('user_edit') }}" method="POST">
    @csrf

    <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="password" value="{{ $password }}">
    <input type="hidden" name="profile" value="{{ $profile }}">

    <h4 class="text-center mb-4">この内容で更新します。よろしいですか？</h4>

    <div class="text-center">
        <label>ユーザー名</label><br>
        <P>{{ $name }}</P>
    </div>

    <div class="text-center">
        <label>メールアドレス</label><br>
        <p>{{ $email }}</p>
    </div>

    <div class="text-center">
        <label>パスワード</label><br>
        <p>{{ $password }}</p>
    </div>

    <div class="text-center">
        <label>プロフィール</label><br>
        <p>{{ $profile }}</p>
    </div>

    <button type="submit" class="btn btn-primary w-100">プロフィール更新</button>
    

</form>

<div class="text-center">
    <a href="{{ route('user_edit') }}">編集画面へ戻る</a>
</div> 

@endsection