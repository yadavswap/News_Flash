<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title','last_name', 'content', 'post_type','author_id','category_id','meta_data'
    ];

    public function author(){
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function link(){
        return '/posts/'.$this->id;
    }

    public function scopeIdDescending($query)
    {
        return $query->orderBy('created_at','DESC');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
