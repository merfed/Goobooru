<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pooled extends Model
{
    protected $table = 'boorus_pools';
    protected $guarded = ['id'];
}
