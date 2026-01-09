<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Post;
use App\Post_image;
use App\Tag;
use App\Post_tag;

class DisplayController extends Controller
{
    // 管理者ページ表示用
    public function dashboard()
    {
        $user = Auth::user();
        if ($user->role !== 0) {
            abort(403); // 権限なし
        }

        return view('admin/dashboard'); // 管理者用ビュー
    }

    // 管理者用ユーザー検索結果表示画面
    public function userSearch(Request $request)
    {
        $query = User::where('role', 1); // 一般ユーザー対象

        if ($request->filled('username') || $request->has('sort')) {
            $query->withCount(['posts', 'likes']);
        }

        // ユーザー名検索（空欄なら全件対象）
        if ($request->filled('username')) {
            $query->where('name', 'like', '%' . $request->username . '%');
        }

        // ソート処理
        if ($request->sort === 'posts_desc') {
            $query->orderBy('posts_count', 'desc');
        } elseif ($request->sort === 'likes_desc') {
            $query->orderBy('created_at', 'asc'); // 古い順
        } else {
        // デフォルト：新規登録順
            $query->orderBy('created_at', 'desc');
        }

        $users = $query->paginate(10);

        return view('admin/user_list', compact('users'));
    }

    // 管理者用投稿検索ページ表示用
    public function postSearch(Request $request)
{
        $query = Post::with(['user', 'tags']);

        // タイトルもしくはタグ検索（空欄なら全件）
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%')
                ->orWhereHas('tags', function($q) use ($request) {
                    $q->where('tag_name', 'like', '%' . $request->title . '%');
                });
        }

        // ソート処理
        if ($request->sort === 'likes_desc') {
            $query->orderBy('likes_count', 'desc');
        } elseif ($request->sort === 'oldest') {
        $query->orderBy('created_at', 'asc'); // 古い順
        } else {
            $query->orderBy('created_at', 'desc'); // 新しい順（デフォルト）
        }

    $posts = $query->paginate(10);

    return view('admin.post_list', compact('posts'));
}

    // メインページ表示用
    public function index()
    {
        $user = Auth::user();// ログインユーザーの情報を取得

        // フォローユーザーの投稿新着順表示用
        $followPosts = $user ? $user->followingPosts()->get() : collect(); // 未ログイン時は空のコレクション

        return view('Contents/main', [
        'followPosts' => $followPosts,
    ]);
    }

    // マイページ表示用
    public function mypage()
    {
        $user = Auth::user(); // ログインユーザーの情報を取得
        $posts = $user->posts()->with('post_image')->latest()->get(); // リレーションを介して投稿と画像を取得

    return view('Contents/mypage', compact('user', 'posts'));
    }

    // 作品検索結果表示用
    public function post_search(Request $request)
    {
        $keyword = $request->input('tag');

        $tag = Tag::where('tag_name', $keyword)->first();

        // タグが存在しない場合
        if (!$tag) {
            return view('Contents/post_search', [
                'posts' => collect(),
                'tag_name' => $keyword
            ]);
        }

        // 入力されたタグを持つ投稿を取得（論理削除ユーザーは検索対象から除外）
        $posts = $tag->posts()
            ->whereHas('user', function ($query) {
                $query->where('del_flg', 0);
            })
            ->with('post_image', 'user')
            ->get();

        return view('Contents/post_search', [
            'posts' => $posts,
            'tag_name' => $tag->tag_name
        ]);

    }

    public function user_page($id)
    {
        $user = User::where('id', $id)->where('del_flg', 0)->firstOrFail(); // 論理削除除外
        $posts = $user->posts()->with('post_image')->get();

        return view('Contents/user_page', compact('user', 'posts'));
    }

    // 作品詳細画面表示用
    public function post_detail($id)
    {
    $post = Post::with(['post_image', 'user', 'tags'])->findOrFail($id);

    return view('Contents/post_detail', compact('post'));
    }

    // 自分の作品詳細画面表示用
public function mypost_detail($id)
{
    $post = Post::with(['post_image', 'user', 'tags'])->findOrFail($id);

    // 自分の投稿でなければアクセス不可にする場合
    if ($post->user_id !== Auth::id()) {
        abort(403); // またはリダイレクト
    }

    return view('Contents/mypost_detail', compact('post'));
}

}    
