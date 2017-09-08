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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Issue::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'project_id' => 1,
        'status_id' => 1,
        'issue_type_id' => 1,
        'title' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'name' => $faker->word,
        'shortcode' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
    ];
});

$factory->define(App\IssueStatus::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'name' => $faker->word,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
    ];
});

$factory->define(App\IssueType::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'name' => $faker->word,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
    ];
});

