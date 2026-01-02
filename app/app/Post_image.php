<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_image extends Model
{
    protected $fillable = ['post_id', 'img_path'];

    // 投稿とのリレーション（多対1）
    public function post()
    {
        return $this->belongsTo(Post::class);
        // belongsTo...「このモデルは他のモデルに属している」関係
    }
}