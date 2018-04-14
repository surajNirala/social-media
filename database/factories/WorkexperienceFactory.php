<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Workexperience::class, function (Faker $faker) {
    return [
        'user_id'	   	 => $faker->randomElement(App\User::pluck('id')->toArray()),
        'company'	 	 => $faker->company,
        'designation'	 => 'Web Developer',
        'from_year'		 => $faker->year($max = 'now'),
        'to_year'		 => $faker->year($max = 'now'),
        'city'			 => $faker->city,
        'description'	 => $faker->text($maxNbChars = 250),
    ];
});
