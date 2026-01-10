@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('reset')

<div class="container mt-5" style="max-width: 400px;">

    <h2 class="text-center mb-4">パスワード再設定</h2>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request()->email }}" required>

            @if ($errors->any())
            <ul class="text-center">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        
        <div class="mb-3">
            <label>新規パスワードを入力</label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>

        <div class="mb-3">
            <label>新規パスワード確認入力</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
        </div>

        <br>
        <button type="submit" class="btn btn-primary w-100">パスワード登録</button>
    </form>

@endsection