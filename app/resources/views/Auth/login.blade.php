@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('login')
    <h2>ログイン</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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

        <a href="{{ route('pwd_reset') }}">パスワードの変更はこちらから</a>

        <button type="submit">ログイン</button>
    </form>

    <p>Googleアカウントでログイン</p>

    <a href="{{ route('register') }}">新規会員登録はこちらから</a>

@endsection
