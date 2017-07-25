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
$factory->define(App\Models\Todo::class, function (Faker\Generator $faker) {
    return [
        'list_id' => $faker->numberBetween(1, 3),
        'name' => $faker->realText(120),
        'tags' => implode(',', $faker->words($faker->numberBetween(1, 3))),
        'content' => $faker->realText(500),
    ];
});
