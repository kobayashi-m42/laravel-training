<?php

use Faker\Generator as Faker;

$factory->define(App\Todo::class, function (Faker $faker) {
    return [
        'title' => 'todo',
        'state' => 0,
    ];
});
