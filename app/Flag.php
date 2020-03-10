<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $guarded = ['id'];

    public function post()
    {
        $this->hasOne('App\Booru', 'id', 'booru_id');
    }
}
