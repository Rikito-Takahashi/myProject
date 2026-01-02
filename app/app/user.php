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

}



