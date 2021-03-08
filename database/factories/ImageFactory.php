<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
    return [
        //
        'description' => $faker->sentence,
        'url' => $faker->picsumUrl(800, 600),
        'post_id'=> $faker->numberBetween(1,100),
        'featured' => $faker->randomElement([true,false]),
    ];
});
