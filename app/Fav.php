<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fav extends Model
{
    protected $guarded = ['id'];

    public function post()
    {
        $this->hasOne('App\Booru', 'id', 'image_id');
    }
}
