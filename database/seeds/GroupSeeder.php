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
        	'title' => 'Codeup',
            'img_url' => 'https://d3c5s1hmka2e2b.cloudfront.net/uploads/topic/image/124/codeup.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 2,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Lassen C/O 2016',
            'img_url' => 'https://static.pexels.com/photos/7075/people-office-group-team-medium.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 3,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Kings C/O 2016'   ,
            'img_url' => 'https://static.pexels.com/photos/7092/desk-office-hero-workspace-medium.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 4,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Codeup Staff' ,
            'img_url' => 'https://static.pexels.com/photos/57825/pexels-photo-57825-medium.jpeg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 5,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Coding Challenge',
            'img_url' => 'https://static.pexels.com/photos/680/black-and-white-apple-desk-macbook-pro-medium.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 6,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'G-Code, A program for inner city youth...learn how you can get involved.',
            'img_url' => 'https://static.pexels.com/photos/129205/pexels-photo-129205-medium.jpeg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 7,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Now Hiring: Get the low down from Tanglers Team and what a day in the life of a Tangler is like.',
            'img_url' => 'https://static.pexels.com/photos/192324/pexels-photo-192324-medium.jpeg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 8,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'UI/UX Design with Michael Truong.',
            'img_url' => 'http://ux.walkme.com/wp-content/uploads/2014/04/UX-Inforgraphic.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 9,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Back to Basics: Learn VueJS with Nico',
            'img_url' => 'http://whatpixel.com/images/2016/04/00-featured-vuejs-logo-simple.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);

        DB::table('groups')->insert([
            'id' => 10,
            'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
            'password' => bcrypt('secret'), //bcrypt(str_random(10))
            'title' => 'Fast Forward Integration: Learn API integration with Jose.',
            'img_url' => 'http://cloud-elements.com/wp-content/uploads/2014/02/CloudStorageElementPage-01.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //dont know if we need created at or deleted at or laravel takes care of it
        ]);
    }
}
