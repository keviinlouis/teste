<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 15/10/18
 * Time: 13:30
 */


use Faker\Generator as Faker;


$factory->define(App\Models\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status' => \App\Models\Employee::STATUS_ACTIVE,
    ];
});
