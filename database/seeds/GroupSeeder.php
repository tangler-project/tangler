<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\Group::class, 10)->create();
        DB::table('groups')->insert([
        	'id' => 1,
        	'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
        	'password' => bcrypt('secret'), //bcrypt(str_random(10))
        	// 'description' => 'Hey Guys! Found this event going on in Houston on Saturday, November 5, 2016. Want to go?:  The National Museum of Funeral History will host a Dia de los Muertos celebration with activities that commemorate the lives of those who have passed.  Traditionally celebrated between October 31 and November 2, Dia de los Muertos – also known as the Day of the Dead – marks a time when the deceased return to visit the living.Objects like candles, incense, artificial flowers, personal items, photos, food, and water are often used to celebrate and welcome the dead back to earth.',
        	'title' => 'Photography',
            'img_url' => '/img/group-banners/gb1.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 2,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Subway marathons',
            'img_url' => '/img/group-banners/gb2.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 3,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Colorful Design',
            'img_url' => '/img/group-banners/gb3.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 4,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Visit Venice',
            'img_url' => '/img/group-banners/gb4.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 5,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Color experts',
            'img_url' => '/img/group-banners/gb5.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 6,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Electronic music',
            'img_url' => '/img/group-banners/gb6.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 7,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Bonsai',
            'img_url' => '/img/group-banners/gb7.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 8,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Night Life Freaks',
            'img_url' => '/img/group-banners/gb8.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 9,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Beautiful Japan',
            'img_url' => '/img/group-banners/gb9.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 10,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Geography Lovers',
            'img_url' => '/img/group-banners/gb10.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);
    }
}
