<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagged extends Model
{
    protected $table = 'boorus_tags';
    protected $guarded = ['id'];
}
