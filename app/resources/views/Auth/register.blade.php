@extends('layouts.login_layout')
{{-- @section('title', '新規登録') --}}

@section('signup')

<div class="container mt-5" style="max-width: 400px;">

    <h2 class="text-center mb-4">新規登録</h2>

    <form action="{{ route('register_conf') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>ユーザー名</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
            <label>メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3">
            <label>パスワード</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label>パスワード確認</label>
            <input type="password" class="form-control" id="password_conf" name="password_conf">
        </div>

        <br>
        <button type="submit" class="btn btn-primary w-100" >内容確認</button>
    </form>

    <div class="text-center">
        <a href="{{ route('login.google') }}">Googleアカウントで登録</a>
    </div>
    
    <div class="text-center">
        <a href="{{ route('login') }}">ログイン画面に戻る</a>
    </div>

</div>

@endsection