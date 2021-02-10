<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        
        'category_id'=>$faker->numberBetween(1, 100),
        'user_id'=> $faker->numberBetween(1, 40),
        'title'=>$faker->sentence()

    ];
});
