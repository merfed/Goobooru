<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    protected $table = 'forum_comments';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
