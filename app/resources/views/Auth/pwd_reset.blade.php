@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('pwd_reset')

<div class="container mt-5" style="max-width: 400px;">

    <h2 class="text-center mb-4">パスワード再設定</h2>

    <form action="{{ route('pwd_resetMail') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            <span>{{ $errors->first('email') }}</span>
        </div>

        <button type="submit" class="btn btn-primary w-100">再設定案内メール送信</button>

    </form>

    <div class="text-center">
        <a href="{{ route('login') }}">ログイン画面に戻る</a>
    </div>    

@endsection
