<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Model\Profile::class, function (Faker $faker) {
    return [
        'user_id'	   	 => $faker->randomElement(App\User::pluck('id')->toArray()),
        'profile_image'	 => $faker->image(('public/profile_images'),400,300),
        'cover_image'	 => $faker->image(('public/cover_images'),820,320),
        'mobile'		 => $faker->phoneNumber,	
        'username'		 => $faker->unique()->userName,
        'city'			 => $faker->city,
        'country'		 => $faker->country,
    ];
});
