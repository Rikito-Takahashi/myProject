<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\user;

class RegisterController extends Controller
{
    // 新規登録フォーム用
    public function registerForm(){
        return view('Auth/register');
    }//

    // 確認画面用
    public function register_conf(Request $request){
        return view('Auth/register_conf', [
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'password_conf' => $request->password_conf,
        ]);

    }

    // 完了画面用
        public function register_comp(Request $request){
        
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        // usersテーブルへユーザー情報登録
        $user->save();

        return view('Auth/register_comp');
    }
}
