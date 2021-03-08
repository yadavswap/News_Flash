<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;


$factory->define(Tag::class, function (Faker $faker) {
    $title = $faker->word;
    $slug = str_slug($title);
    return [
        //
        'title'=>$title,
        'slug'=>$slug
    ];
});
