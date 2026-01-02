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
    // メインページ表示用
    public function index()
    {
        return view('Contents/main');
    }//

    // マイページ表示用
    public function mypage()
    {
        $user = Auth::user(); // ログインユーザーの情報を取得
        $posts = $user->posts()->with('post_image')->latest()->get(); // リレーションを介して投稿と画像を取得

    return view('Contents/mypage', compact('user', 'posts'));
    }

}
