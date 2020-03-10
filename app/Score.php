<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'boorus_scores';
    protected $guarded = ['id'];

    public function post()
    {
        $this->hasOne('App\Booru', 'id', 'image_id');
    }
}
