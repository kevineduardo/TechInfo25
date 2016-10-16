<?php
// Copyright (C) 2016  Kevin Souza
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