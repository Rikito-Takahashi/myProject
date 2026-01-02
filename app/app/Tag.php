<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    protected $fillable = ['tag_name'];

    public $timestamps = true;

    // 投稿とのリレーション（多対多）
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
        // belongsToMany...「このモデルは他のモデルと多対多の関係にある」関係
    }
}