<?php

use Faker\Generator as Faker;
use \Cviebrock\EloquentSluggable\Services\SlugService;
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

$factory->define(App\Post::class, function (Faker $faker) {
	
	$title = $faker->sentence();
	$user_ids = App\User::pluck('id');
	
	return [
		'title' => $title,
		'slug' => SlugService::createSlug(App\Post::class, 'slug', $title),
    	'is_active' =>  $faker->numberBetween(0, 1),
    	'content' => $faker->paragraph(20),
		'category_id' => $faker->numberBetween(1, 3),
		'user_id' => $user_ids->random(),
	];
});
       