@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('pwd_reset')
    <h2>パスワード再設定</h2>

    <form action="{{ route('reset.send') }}" method="POST">
        @csrf

        <div>
            <label>メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('mail') }}">
            <span>{{ $errors->first('mail') }}</span>
        </div>
        <a href="{{ route('login') }}">戻る</a>
        <button type="submit">再設定案内メール送信</button>
    </form>

@endsection
