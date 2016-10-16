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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Teacher::class, function (Faker\Generator $faker) {
    static $user_id;
    static $type;

    return [
        'user_id' => $user_id ?: $user_id = 1,
        'type' => $type ?: $type = 1,
        'bio' => str_random(100),
        'academic_bg' => str_random(10),
    ];
});