<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Model\Post::class, function (Faker $faker) {
    return [
		/*'user_id'      => function(){

		    	return App\User::all()->random();
		    },*/
		'user_id'	   => $faker->randomElement(App\User::pluck('id')->toArray()),  
        'post_content' => $faker->text($maxNbChars = 250),
        'post_file'	   => $faker->image(('public/post_images'),400,300),
        'like'		   => $faker->randomDigit,
        'dislike'	   => $faker->randomDigit,
    ];
});
