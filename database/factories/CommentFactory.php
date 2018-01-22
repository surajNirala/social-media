<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Model\Comment::class, function (Faker $faker) {
    return [
        'user_id'	   	 => $faker->randomElement(App\User::pluck('id')->toArray()),
        'post_id'	   	 => $faker->randomElement(App\Model\Post::pluck('id')->toArray()),  
        'comment_content'=> $faker->text($maxNbChars = 250),
    ];
});
