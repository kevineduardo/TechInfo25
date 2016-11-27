<?php
// Copyright (C) 2016  Kevin Souza
$factory->define(App\Teacher::class, function (Faker\Generator $faker) {
    static $type;

    return [
        'user_id' => 1,
        'type' => $type ?: $type = 1,
        'bio' => str_random(100),
        'academic_bg' => str_random(10),
    ];
});

$factory->define(App\Categorie::class, function (Faker\Generator $faker) {
    static $icon;

    return [
        'name' => $faker->unique()->numerify('Cat #'),
        'icon' => $icon ?: $icon = 'glyphicon-book',
    ];
});

$factory->define(App\Page::class, function (Faker\Generator $faker) {
    static $author_id;
    static $editor_id;
    static $edited;

    return [
        'title' => $faker->unique()->numerify('Page #'),
        'text' => str_random(500),
        'navbar_icon' => 'glyphicon-book',
        'type' => 1,
        'author_id' => $author_id ?: $author_id = 1,
        'edited' => $edited ?: $edited = false,
        'editor_id' => $editor_id ?: $editor_id = null,
        'tags' => null,
    ];
});

$factory->define(App\CategoryPageAttr::class, function () {
    return [
        'page_id' => factory(App\Page::class)->create()->id,
        'category_id' => factory(App\Categorie::class)->create()->id,
    ];
});

$factory->define(App\Picture::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->unique()->numerify('Picture #'),
        'description' => str_random(30),
        'path' => 'storage/teste.jpg',
        'author_id' => 1,
    ];
});

$factory->define(App\Calendar::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->numerify('Event ###'),
        'description' => str_random(30),
        'place' => 'Copacabana',
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'time' => $faker->time(),
        'role' => 1,
        'author_id' => 1,
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
    static $author_id;
    static $editor_id;
    static $edited;

    return [
        'title' => $faker->unique()->numerify('News ###'),
        'subtitle' => str_random(10),
        'text' => str_random(500),
        'published' => true,
        'author_id' => $author_id ?: $author_id = 1,
        'edited' => $edited ?: $edited = false,
        'editor_id' => $editor_id ?: $editor_id = null,
        'published_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'tags' => null,
    ];
});