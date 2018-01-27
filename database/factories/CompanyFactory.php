<?php

use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Company;

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

$factory->define(App\Company::class, function (Faker $faker) {
	$faker->addProvider(new Company($faker));

    return [
    	'name' => $faker->company,
        'cnpj' => $faker->cnpj(false)
    ];
});