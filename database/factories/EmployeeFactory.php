<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'patronymic' => $faker->word,
        'date_of_birth' => $faker->date(),
        'department_id' => $faker->numberBetween(1,10),
        'job_position' => $faker->word,
        'type' => 1,
        'monthly_rate' => $faker->numberBetween(300,700),
    ];
});
