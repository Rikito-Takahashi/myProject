<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;// パスワード再設定用メール送信用の機能をまとめたトレイト
use Illuminate\Foundation\Auth\ResetsPasswords;// パスワードリセット処理（更新など）をまとめたトレイト

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;// パスワードリセット関連の処理に使うファサード
// ファサード（Facade）...Laravelが提供する「便利なショートカット機能」のひとつで、クラスやサービスへの簡潔なアクセス手段。
// サービスコンテナ（依存注入の仕組み）を使って、実体のクラスを呼び出している。

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails, ResetsPasswords{
    ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
    ResetsPasswords::broker insteadof SendsPasswordResetEmails;
    ResetsPasswords::guard insteadof SendsPasswordResetEmails;
    // insteadof は、PHP の トレイト（trait） で使われるキーワード
    //「同じメソッド名が複数のトレイトに存在するとき、どちらを優先するかを明示する」ために使う
    // 今回の場合は[ResetsPasswords]側を優先して使う設定
    }


        // パスワード再設定メール送信用フォームを表示
        // ユーザーがメールアドレスを入力する画面を返す
    public function showLinkRequestForm()
    {
        return view('Auth/pwd_reset');
    }

    // メール送信処理
    // 入力されたメールアドレス宛に再設定用リンクを送信する
    public function sendResetLinkEmail(Request $request)
    {
        // バリデーション
        // メールアドレスが必須、かつusersテーブルに存在するかをチェック
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // メール送信処理（トークン生成とDB保存含む）
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // メール送信成功時 → 送信完了画面へリダイレクト
        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('mail_complete');
        }

        // エラーがある場合は入力画面へ戻す（エラーメッセージも表示）
        return back()->withErrors(['email' => __($status)]);
    }


    // 再設定メール送信完了後の画面を表示
        public function mail_complete()
    {
        return view('Auth/mail_complete');
    }

    // メール内リンクから遷移してくるパスワード再設定フォームを表示
    // トークンとメールアドレスをビューに渡す
        public function showResetForm(Request $request, $token = null)
    {
        return view('auth/passwords/reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }
}
