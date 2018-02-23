<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Education::class, function (Faker $faker) {
    return [
        'user_id'	   	 => $faker->randomElement(App\User::pluck('id')->toArray()),
        'university'	 => 'upt university',
        'course'		 => 'B.tech',	
        'from_year'		 => $faker->year($max = 'now'),
        'to_year'		 => '2012',
        'description'	 => $faker->text($maxNbChars = 250),
    ];
});
