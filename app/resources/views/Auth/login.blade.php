@extends('layouts.login_layout')
{{-- @section('title', 'ログイン') --}}

@section('login')

<div class="container mt-5" style="max-width: 400px;">

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

    <h2 class="text-center mb-4">ログイン</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3">
            <label>パスワード</label>
            <input type="password" class="form-control" id="password" name="password">
            <a href="{{ route('pwd_reset') }}"><span class="text-center">パスワードを忘れた場合はこちら</span></a>
        </div>


        <button type="submit" class="btn btn-primary w-100">ログイン</button>
    </form>

    <div class="text-center">
    <a href="{{ route('login.google') }}"><P>Googleアカウントでログイン</P></a>
    </div>

    <div class="mt-3 text-center">
    <a href="{{ route('register') }}">新規会員登録はこちらから</a>
    </div>

</div>    

@endsection
