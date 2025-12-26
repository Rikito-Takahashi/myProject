<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


// class UserRepository implements UserRepositoryInterface
// {
    // private $user;
    // // private $userToken;

    // /**
    //  * constructor
    //  *
    //  * @param User $user
    //  */
    // public function __construct(User $user)
    // {
    //     $this->user = $user;
    //     // $this->userToken = $userToken;
    // }

    // // メールアドレスからユーザー情報取得
    // public function findFromMail(string $mail): User
    // {
    //     return $this->user->where('mail', $mail)->firstOrFail();
    // }

    // // パスワードリセット用トークンを発行
    // public function updateOrCreateUser(int $userId): User
    // {
    //     $now = Carbon::now();
    //     // $userIdをハッシュ化
    //     $hashedToken = hash('sha256', $userId);
    //     return $this->userToken->updateOrCreate(
    //     ['email' => $email],
    //     [
    //         'email' => $email,
    //         'token' => $token,
    //         'created_at' => Carbon::now(),
    //     ]
    // );

    // return $token;
    // }

    class UserRepository implements UserRepositoryInterface
{
    private $user;

    /**
     * constructor
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // メールアドレスからユーザー情報取得
    public function findFromMail(string $mail): User
    {
        return $this->user->where('email', $mail)->firstOrFail(); // "mail" → "email" に修正
    }

    // パスワードリセット用トークンを発行
    public function updateOrCreateUser(int $userId): string
    {
        $user = $this->user->findOrFail($userId); // ユーザー取得
        $email = $user->email;

        $token = Str::random(60); // トークン生成

        // パスワードリセット情報を更新・作成
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $token,
                'created_at' => Carbon::now(),
            ]
        );

        return $token;
    }
}
// }