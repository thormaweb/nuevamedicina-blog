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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $category_ids = \DB::table('article_categories')->select('id')->get();
    $category_id = $faker->randomElement($category_ids->toArray())->id;

    return [
        'category_id' => $category_id,
        'name' => $faker->streetName,
        'enable' => true,
        'text' => $faker->realText(1500),
        'slug' => $faker->unique()->slug,
    ];
});