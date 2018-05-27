<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\user');
    }

    public function comments()
    {
        return $this->hasMany('App\comment');
    }
}
