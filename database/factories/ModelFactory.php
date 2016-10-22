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
		'description' => $faker->paragraphs(2,true)
	];
});

$factory->define(App\Models\UserGroup::class, function (Faker\Generator $faker) {

	return [
		'user_id' => App\User::all()->random()->id,
		'group_id' => App\Models\Group::all()->random()->id
	];
});

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {

	return [
		'title' => $faker->words(4,true),
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
		'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'end_date' => $faker->date($format = 'Y-m-d', $max = 'now')

	];
});







