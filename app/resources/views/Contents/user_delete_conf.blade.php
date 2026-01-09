@extends('layouts.Contents_layout')

@section('user_delete_conf')

<h3>アカウント削除確認</h3>


<form action="{{ route('user_delete') }}" method="POST">
    @csrf

    {{-- <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="password" value="{{ $password }}">
    <input type="hidden" name="profile" value="{{ $profile }}"> --}}

    <div>
        @if($user->header_img)
            <img src="{{ asset('storage/' . $user->header_img) }}" alt="ヘッダー画像">
        @endif
    </div>
    
    <h5>アカウントを削除します。<br>よろしいですか？</h5>

    <div>
        @if($user->icon_img)
            <img src="{{ asset('storage/' . $user->icon_img) }}" alt="ユーザーアイコン">
        @endif
    </div>

    <div>
        <label>ユーザー名</label><br>
        <P>{{ $user->name }}</P>
    </div>

    <div>
        <label>メールアドレス</label><br>
        <p>{{ $user->email }}</p>
    </div>

    <div>
        <label>プロフィール</label><br>
        <p>{{ $user->profile }}</p>
    </div>

    <button type="submit" >アカウントを削除する</button>
    

</form>

<a href="{{ route('mypage') }}">マイページへ戻る</a>

@endsection