<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteDetail extends Model
{
    //
    protected $fillable = [
        'title','link', 'website_image'
    ];
}
