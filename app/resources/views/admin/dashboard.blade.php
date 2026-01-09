@extends('layouts.kanrisya_layout')

@section('kanrisya')

    <h1>管理者専用ページ</h1>
    
    {{-- ユーザー検索フォーム --}}
<form action="{{ route('admin.user_list') }}" method="GET">
    <label>ユーザー検索</label><br>
    <input type="text" name="username" placeholder="ユーザー名を入力">
    <button type="submit">検索</button>
</form>

<br>

{{-- 作品検索フォーム --}}
<form action="{{ route('admin.post_list') }}" method="GET">
    <label>作品検索</label><br>
    <input type="text" name="title" placeholder="作品タグを入力">
    <button type="submit">検索</button>
</form>

@endsection