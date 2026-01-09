<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Str;

class GoogleLoginController extends Controller
{
    // Google認証ページへリダイレクト
    public function redirectToGoogle()
    {
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::firstOrCreate([
        'email' => $googleUser->getEmail()
    ], [
        'name' => $googleUser->getName(),
        'password' => bcrypt(Str::random(16)), // 任意のダミーパスワード
        'role' => 1 // 一般ユーザーとして登録
    ]);

    Auth::login($user);
    return redirect()->route('main');
}
}