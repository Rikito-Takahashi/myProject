@extends('layouts.login_layout')
{{-- @section('title', '新規登録') --}}

@section('signup')
    <h1>新規登録が完了しました</h1>

    <a href="{{ route('login') }}">ログイン画面へ</a>

@endsection