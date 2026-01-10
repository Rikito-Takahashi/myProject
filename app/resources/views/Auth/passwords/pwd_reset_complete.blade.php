@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('pwd_reset_complete')

<div class="container mt-5" style="max-width: 400px;">

    <h2 class="text-center mb-4">パスワード変更完了</h2>
    <div class="text-center">
        <p>パスワードの変更が完了しました</p>
        <p>新しいパスワードにて再ログインしてください</p>
    </div>
    <div class="text-center">
    <a href="{{ route('/Auth/login') }}">ログイン画面へ</a>
    </div>
@endsection