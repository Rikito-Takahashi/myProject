@extends('layouts.kanrisya_layout')

@section('kanrisya_post')

<h1>作品検索結果</h1>

{{-- 検索フォーム --}}
<form action="{{ route('admin.post_list') }}" method="GET">
    <label>作品検索：</label>
    <input type="text" name="tag" placeholder="タグ名を入力" value="{{ request('tag') }}">
    
    <select name="sort">
        <option value="">新着順</option>
        <option value="likes_desc" {{ request('sort') == 'likes_desc' ? 'selected' : '' }}>いいね数順</option>
        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>古い順</option>
    </select>

    <button type="submit">検索</button>
</form>

<br>

{{-- 結果表示 --}}
<table border="1">
    <thead>
        <tr>
            <th>作品ID</th>
            <th>ユーザー名</th>
            <th>作品名</th>
            <th>登録タグ</th>
            {{-- <th>Like!数</th> --}}
            <th>投稿日時</th>
            <th>詳細</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->title }}</td>
            <td>
                {{ $post->tags->pluck('tag_name')->join(', ') }}
            </td>
            {{-- <td>{{ $post->likes_count ?? $post->likes->count() }}</td> --}}
            <td>{{ $post->created_at->format('Y/m/d H:i') }}</td>
            <td><a href="{{ route('post_detail', ['id' => $post->id]) }}">作品詳細へ</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->appends(request()->query())->links() }}

@endsection