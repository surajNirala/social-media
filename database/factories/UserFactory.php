<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
	$filePath = storage_path('images');
    return [
        'first_name' 			=> $faker->firstName,
        'last_name'				=> $faker->lastName,
        'profile_image'			=> $faker->image('public/images',400,300),
        'cover_image'		    => $faker->imageUrl($width = 820, $height = 312),
        'mobile'				=> $faker->phoneNumber,	
        'username'				=> $faker->unique()->userName,
        'email' 				=> $faker->unique()->freeEmail,
        'password' 				=> bcrypt('secret'),
        'dop'					=> $faker
        						   ->dateTimeBetween('-40 years', '-18 years'),
        'city'					=> $faker->city,
        'country'				=> $faker->country,
        'remember_token' 		=> str_random(10),
    ];
});
