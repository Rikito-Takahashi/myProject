<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_tag extends Model
{
    protected $fillable = ['post_id', 'tag_id'];

    // timestamps不要なため無効化
    public $timestamps = false;
}