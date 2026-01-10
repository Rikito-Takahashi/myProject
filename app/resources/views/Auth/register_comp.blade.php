@extends('layouts.login_layout')
{{-- @section('title', '新規登録') --}}

@section('signup')

<div class="container mt-5" style="max-width: 400px;">

    <h2 class="text-center mb-4">新規登録が完了しました</h2>

    <div class="text-center">
        <a href="{{ route('login') }}">ログイン画面へ</a>
    </div>    

@endsection