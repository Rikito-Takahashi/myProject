<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Authファサードを読み込む
use App\Models\User;


class FollowController extends Controller
{
        public function toggle(Request $request)
    {
        $user = Auth::user();
        $followId = $request->input('follow_id');

        // すでにフォローしていれば削除（フォロー解除）、なければ追加（フォロー）
        $follow = $user->followings()->where('follow_id', $followId)->first();

        if ($follow) {
            // フォロー解除
            $user->followings()->detach($followId);
            return response()->json(['status' => 'unfollowed']);
        } else {
            // フォロー
            $user->followings()->attach($followId);
            return response()->json(['status' => 'followed']);
        }
    }
}
