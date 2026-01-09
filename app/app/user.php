<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;


class User extends Authenticatable implements CanResetPassword 
{
    use Notifiable;
    use CanResetPasswordTrait;
    
    protected $fillable = ['name', 'email', 'password', 'icon_img', 'header_img', 'profile'];

    // ユーザーの投稿表示用リレーション
    public function posts(){

    return $this->hasMany(Post::class);

    }

    
    public function likes(){

    return $this->hasMany(Like::class);

    }

    // フォロー/フォロワー
    public function followings(){
        
    // 自分がフォローしているユーザー
    return $this->belongsToMany(User::class, 'follows', 'user_id', 'follow_id');

    }

    public function followers(){

    // 自分をフォローしているユーザー(フォロワー)
    return $this->belongsToMany(User::class, 'follows', 'follow_id', 'user_id');

    }

    // フォローしているかどうか判定
    public function isFollowing($userId){

    return $this->followings()->where('follow_id', $userId)->exists();

    }

    // メインページ(main.blade.php)でのフォローユーザー投稿新着表示用
    public function followingPosts(){
    return Post::whereIn('user_id', $this->followings()->pluck('follow_id'))
    // whereIn...「あるカラムの値が、指定した配列の中に含まれているか」を条件にするEloquent/クエリビルダのメソッド
    // 今回の場合、投稿のuser_idが、自分がフォローしているユーザーのIDの中に含まれている投稿を取得している
               ->whereHas('user', function ($query) {
                   $query->where('del_flg', 0);
               })
               ->with(['user', 'post_image']) // 投稿者や画像も取得
               ->orderBy('created_at', 'desc');// 新着順表示の指示
    }

}



