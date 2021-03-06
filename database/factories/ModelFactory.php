<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\News::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => str_random(10),
        'text' => $faker->paragraphs(3, true),
        'url' => str_random(10),
        'image' => $faker->imageUrl('200', '200', 'cats')
    ];
});
