<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'post_id', 'creator_id'];
    protected $with = ['creator', 'replies'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'comment_id');
    }

    public function reply($data)
    {
        return $this->replies()->create($data);
    }
}
