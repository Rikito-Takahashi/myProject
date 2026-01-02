@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('reset')
    <h2>パスワード再設定</h2>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request()->email }}" required>

            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        
        <div>
            <label>新規パスワードを入力</label>
            <input type="password" id="password" name="password" value="">
        </div>

        <div>
            <label>新規パスワード確認入力</label>
            <input type="password" id="password_confirmation" name="password_confirmation" value="">
        </div>

        <button type="submit">パスワード登録</button>
    </form>

@endsection