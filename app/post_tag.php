<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post_tag extends Model
{
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
