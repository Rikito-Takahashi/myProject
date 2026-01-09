@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('login')

    {{-- アカウント論理削除完了後リダイレクト時メッセージ表示関連ここから --}}
@if(session('success'))
    <div class="popup-message">
        <h4>{{ session('success') }}</h4>
    </div>
@endif

<script>
    setTimeout(() => {
        const popup = document.querySelector('.popup-message');
        if (popup) popup.style.display = 'none';
    }, 3000); // 3秒で非表示
</script>
{{-- アカウント論理削除完了後リダイレクト時メッセージ表示関連ここから --}}

    <h2>ログイン</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div>
            <label>メールアドレス</label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label>パスワード</label>
            <input type="password" id="password" name="password">
        </div>

        <a href="{{ route('pwd_reset') }}">パスワードの変更はこちらから</a>

        <button type="submit">ログイン</button>
    </form>

    <a href="{{ route('login.google') }}"><P>Googleアカウントでログイン</P></a>

    <a href="{{ route('register') }}">新規会員登録はこちらから</a>

@endsection
