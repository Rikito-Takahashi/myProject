<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/main';//ログイン成功時にmain.blade.phpへリダイレクト

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // 論理削除されたユーザーのログイン防止用
    protected function credentials(Request $request){
        return [
            'email' => $request->email,
            'password' => $request->password,
            'del_flg' => 0 // これで del_flg=1 のユーザーをブロック
        ];
    }

    // 管理者ログイン用
    protected function authenticated(Request $request, $user){

    if ($user->role == 0) {
        return redirect()->route('admin.dashboard'); // 管理者用ページ
    }

    return redirect()->route('main'); // 一般ユーザー用メインページ
    }

    public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

// Googleアカウントでのログイン機能用
public function handleGoogleCallback()
{
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(uniqid()), // パスワードはランダムで問題ありません
        ]
    );

    Auth::login($user);

    return redirect()->route('main');
}

}
