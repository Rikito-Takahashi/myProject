@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('login')
    <h2>ログイン</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div>
            <label>メールアドレス</label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label>パスワード</label>
            <input type="password" id="password" name="password">
        </div>

        <a href="">パスワードの変更はこちらから</a>

        <button type="submit">ログイン</button>
    </form>

    <p>Googleアカウントでログイン</p>

    <a href="{{ route('register') }}">新規会員登録はこちらから</a>

@endsection
