<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function post()
    {
        return $this->hasOne('App\Booru', 'id' ,'booru_id');
    }
}
