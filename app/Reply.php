<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['body', 'comment_id', 'creator_id'];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
