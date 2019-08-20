<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'tarea' => $faker->sentence,
        'realizada' => $faker->boolean
    ];
});
