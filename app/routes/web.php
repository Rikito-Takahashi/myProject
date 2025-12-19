<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegisterController;

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
Auth::routes();

Route::get('/', [DisplayController::class, 'index'])->name('login');

// 新規登録フォーム用
Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');

// 確認画面用
Route::post('/register_conf', [RegisterController::class, 'register_conf'])->name('register_conf');

// 完了画面用
Route::post('/register_comp', [RegisterController::class, 'register_comp'])->name('register_comp');
// Route::get('/', function () {
//     return view('login');
// });
