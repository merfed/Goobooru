<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 'boorus_sources';
    protected $guarded = ['id'];

    public function post()
    {
        $this->hasOne('App\Booru', 'id', 'booru_id');
    }
}
