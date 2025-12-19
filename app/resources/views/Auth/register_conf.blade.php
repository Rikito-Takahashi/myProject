@extends('layouts.login_layout')
{{-- @section('title', '新規登録') --}}

@section('signup_conf')
    <h2>新規登録内容確認</h2>

    <form action="{{ route('register_comp') }}" method="POST">
        @csrf

        <div>
            <label>ユーザー名</label>
            <p>{{ $name }}</p>
        </div>

        <div>
            <label>メールアドレス</label>
            <p>{{ $email }}</p>
        </div>

        <div>
            <label>パスワード</label>
            <p>{{ $password }}</p>
        </div>

        <div>
            <label>パスワード確認</label>
            <p>{{ $password_conf }}</p>
        </div>

        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="password" value="{{ $password }}">

        <button type="submit">登録する</button>

        <a href="{{ route('register') }}">入力内容を修正する</a>

    </form>

    <a href="">Googleアカウントで登録</a>

@endsection