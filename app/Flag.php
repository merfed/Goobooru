<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $table = 'boorus_flags';
    protected $guarded = ['id'];

    public function post()
    {
        return $this->hasOne('App\Booru', 'id', 'booru_id');
    }
}
