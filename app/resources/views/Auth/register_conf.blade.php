@extends('layouts.login_layout')
{{-- @section('title', '新規登録') --}}

@section('signup_conf')

<div class="container mt-5" style="max-width: 400px;">

    <h2 class="text-center mb-4">新規登録内容確認</h2>

    <form action="{{ route('register_comp') }}" method="POST">
        @csrf

        <div class="text-center">
            <label>ユーザー名</label>
            <p>{{ $name }}</p>
        </div>

        <div class="text-center">
            <label>メールアドレス</label>
            <p>{{ $email }}</p>
        </div>

        <div class="text-center">
            <label>パスワード</label>
            <p>{{ $password }}</p>
        </div>

        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="password" value="{{ $password }}">

        <button type="submit" class="btn btn-primary w-100">登録する</button>


    </form>

        <div class="text-center">
            <a href="{{ route('register') }}"><p>入力内容を修正する</p></a>
        </div>


</div>    

@endsection