@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('pwd_form')
    <h2>パスワード再設定</h2>

    <form action="{{ route('pwd_reset_complete') }}" method="POST">
        @csrf
        
        <input type="hidden" name="reset_token" value="{{ $userToken->rest_password_access_key }}">

        <div>
            <label>新規パスワードを入力</label>
            <input type="password" id="password" name="password" value="">
        </div>

        <div>
            <label>新規パスワード確認入力</label>
            <input type="password" id="password_conf" name="password_conf" value="">
        </div>

        <button type="submit">パスワード登録</button>
    </form>

@endsection