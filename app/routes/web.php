<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\Auth\ResetPasswordController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();// Laravel標準の認証ルート（ログイン・ログアウト・パスワードリセット等の一式を内蔵)

// Route::get('/', [DisplayController::class, 'index'])->name('login');

// 新規登録フォーム用
Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');

// 確認画面用
Route::post('/register_conf', [RegisterController::class, 'register_conf'])->name('register_conf');

// 完了画面用
Route::post('/register_comp', [RegisterController::class, 'register_comp'])->name('register_comp');
// Route::get('/', function () {
//     return view('login');
// });

// パスワード再設定用メールアドレス入力画面用
Route::get('/pwd_reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('pwd_reset');

// メール送信処理
Route::post('/pwd_resetMail', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('pwd_resetMail');

// 再設定用メール送信完了画面用
Route::get('/mail_complete', [ForgotPasswordController::class, 'mail_complete'])->name('mail_complete');

// パスワードリセットフォームの表示
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

// パスワード更新完了画面表示
Route::get('/pwd_reset_complete', function () {
    return view('auth/passwords/pwd_reset_complete');
})->name('pwd_reset_complete');

// パスワード更新処理
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// メインページ表示用
Route::group(['middleware' => 'auth'], function() {
    // トップページ。ログイン済みのユーザーだけアクセス可能
    Route::get('/', [DisplayController::class, 'index'])->name('main');
});

// マイページ表示用
Route::get('/mypage', [DisplayController::class, 'mypage'])->name('mypage');

// アカウント情報編集画面表示用
Route::get('/user_edit', [RegisterController::class, 'user_editForm'])->name('user_edit');
// アカウント情報更新処理用
Route::post('/user_edit', [RegisterController::class, 'user_edit'])->name('user_edit');

// 作品投稿画面表示用
Route::get('/create_post', [RegisterController::class, 'create_postForm'])->name('create_post');
// 作品投稿処理用
Route::post('/create_post', [RegisterController::class, 'create_post'])->name('create_post');

