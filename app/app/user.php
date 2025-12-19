<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $fillable = ['name', 'email', 'password', 'icon_img', 'header_img', 'profile'];

}
