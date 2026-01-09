@extends('layouts.kanrisya_layout')

@section('kanrisya_user')

<h2>ユーザー検索結果</h2>

{{-- 検索フォーム --}}
<form action="{{ route('admin.user_list') }}" method="GET">
    <label>ユーザー検索：</label>
    <input type="text" name="username" placeholder="ユーザー名を入力" value="{{ request('username') }}">
    {{-- <button type="submit">検索</button> --}}

    {{-- ソートプルダウン --}}
    <select name="sort" onchange="this.form.submit()">
        <option value="">新着順</option>
        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>古い順</option>
        <option value="posts_desc" {{ request('sort') == 'posts_desc' ? 'selected' : '' }}>投稿数（多い順）</option>
        {{-- <option value="likes_desc" {{ request('sort') == 'likes_desc' ? 'selected' : '' }}>Like数（多い順）</option> --}}
    </select>

    <button type="submit">検索</button>
</form>

{{-- 検索結果テーブル --}}
<table border="1">
    <thead>
        <tr>
            <th>ユーザーID</th>
            <th>ユーザー名</th>
            {{-- <th>投稿数</th> --}}
            {{-- <th>Like!数</th> --}}
            <th>詳細</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            {{-- <td>{{ $user->posts_count }}</td> --}}
            {{-- <td>{{ $user->likes_count }}</td> --}}
            <td><a href="{{ route('user_page', ['id' => $user->id]) }}">ユーザーページへ</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- ページネーション --}}
<div>
    {{ $users->appends(request()->query())->links() }}
</div>

@endsection