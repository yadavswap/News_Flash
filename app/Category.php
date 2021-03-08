<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'title','color','slug'
    ];

    public function posts(){
        return $this->hasMany(Post::class)->orderBy('updated_at','DESC');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
