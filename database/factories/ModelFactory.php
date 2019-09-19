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
$factory->define(App\Vendor::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'website' => $faker->url,
        'description' => $faker->sentence,
        'logo' => 'logo.png',
        'slug' => $faker->unique()->slug,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Product::class, function (Faker\Generator $faker) {
    $category_ids = \DB::table('product_categories')->where('is_parent', false)->select('id')->get();
    $category_id = $faker->randomElement($category_ids->toArray())->id;

    $vendor_ids = \DB::table('vendors')->select('id')->get();
    $vendor_id = $faker->randomElement($vendor_ids->toArray())->id;

    return [
        'category_id' => $category_id,
        'vendor_id' => $vendor_id,
        'name' => $faker->streetName,
        'enable' => true,
        'description' => $faker->sentence,
        'slug' => $faker->unique()->slug,
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