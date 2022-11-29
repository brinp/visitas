<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Moneda;
use Faker\Generator as Faker;

$factory->define(Moneda::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->sentence,
        'sigla'=>$faker->sentence,
        'simbolo'=>$faker->sentence,
    ];
});
