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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'img_url' => $faker->imageUrl($width = 230, $height = 230),
    ];
});

//group owner is private? does it needs to be only one owner
$factory->define(App\Models\Group::class, function (Faker\Generator $faker) {

	return [
		'title' => $faker->words(4,true),
		'img_url' => $faker->imageUrl($width = 230, $height = 230),
		'description' => $faker->paragraphs(2,true),
		'is_private' => $faker->biasedNumberBetween($min = 0, $max = 1),
		'password' => bcrypt(str_random(10))
	];
});

$factory->define(App\Models\UserGroup::class, function (Faker\Generator $faker) {

	return [
		'user_id' => App\User::all()->random()->id,
		'group_id' => App\Models\Group::all()->random()->id,
		'is_owner' => $faker->biasedNumberBetween($min = 0, $max = 1)
	];
});

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {

	return [
		// 'title' => $faker->words(4,true),
		'img_url' => $faker->imageUrl($width = 230, $height = 230),
		'content' => $faker->paragraphs(2,true),
		'owner_id' => App\User::all()->random()->id,
		'group_id' => App\Models\Group::all()->random()->id

	];
});


$factory->define(App\Models\Event::class, function (Faker\Generator $faker) {

	return [
		'title' => $faker->words(4,true),
		'img_url' => $faker->imageUrl($width = 230, $height = 230),
		'content' => $faker->paragraphs(2,true),
		'owner_id' => App\User::all()->random()->id,
		'group_id' => App\Models\Group::all()->random()->id,
		'start_date' => $faker->dateTimeBetween('+1 days', '+5 days', $timezone = date_default_timezone_get()),
		'end_date' => $faker->dateTimeBetween('+6 days', '+2 years', $timezone = date_default_timezone_get())

	];
});







