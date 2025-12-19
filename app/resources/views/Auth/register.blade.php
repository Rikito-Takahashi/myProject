@extends('layouts.login_layout')
{{-- @section('title', '新規登録') --}}

@section('signup')
    <h2>新規登録</h2>

    <form action="{{ route('register_conf') }}" method="POST">
        @csrf

        <div>
            <label>ユーザー名</label>
            <input type="text" id="name" name="name">
        </div>

        <div>
            <label>メールアドレス</label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label>パスワード</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <label>パスワード確認</label>
            <input type="password" id="password_conf" name="password_conf">
        </div>

        <button type="submit" >内容確認</button>
    </form>

    <a href="">Googleアカウントで登録</a>

@endsection