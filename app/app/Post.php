<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'caption', 'post_type'];

    // リレーション（画像1対多など）
    public function images()
    {
        return $this->hasMany(Post_image::class);
        // hasMany...「このモデルは他のモデルを複数持っている」関係
    }

    // タグのリレーション（多対多）
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
        // belongsToMany...「このモデルは他のモデルと多対多の関係にある」関係
    }

    // ユーザーの投稿表示用リレーション
    public function post_image()
    {
    return $this->hasOne(Post_image::class);
    }
}