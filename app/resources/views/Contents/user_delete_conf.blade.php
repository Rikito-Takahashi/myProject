@extends('layouts.Contents_layout')

@section('user_delete_conf')

<br>
<h3 class="text-center mb-4">アカウント削除確認</h3>

<br>


<form action="{{ route('user_delete') }}" method="POST">
    @csrf

    {{-- <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="password" value="{{ $password }}">
    <input type="hidden" name="profile" value="{{ $profile }}"> --}}

    <div>
        @if($user->header_img)
            <img src="{{ asset('storage/' . $user->header_img) }}" alt="ヘッダー画像" class="img-fluid w-100 mb-3" style="object-fit: cover; height: 300px;">
        @endif
    </div>

    <br>
 
<div class="container py-4" style="max-width: 400px;">    

    <h5 class="text-center mb-4">アカウントを削除します。<br>よろしいですか？</h5>

    <div class="container">
        <div class="d-flex justify-content-center align-items-center mb-4">
            
            @if($user->icon_img)
                <img src="{{ asset('storage/' . $user->icon_img) }}" alt="ユーザーアイコン" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
            @endif

            <div class="text-center">
            <P>{{ $user->name }}</P>
            </div>
        </div>

        <div class="text-center">
            <label>メールアドレス</label><br>
                <p>{{ $user->email }}</p>
        </div>

        <div class="text-center">
            <label>プロフィール</label><br>
                <p>{{ $user->profile }}</p>
        </div>

        <br>

        <button type="submit" class="btn btn-Danger w-100" style="width: 100px;">アカウントを削除する</button>
    

    </form>
</div>

<br>

<div class="text-center">
<a href="{{ route('mypage') }}">マイページへ戻る</a>
</div>

</div>
@endsection