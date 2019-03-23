<?php

use App\Monster;
use Illuminate\Support\Str;
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

$factory->define(Monster::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit(),
        'name' => $faker->name,
        'active' => true,
        'lifespan' => 10000
    ];
});
