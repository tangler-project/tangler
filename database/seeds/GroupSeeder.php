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
        factory(App\Models\Group::class, 10)->create();
        // DB::table('groups')->insert([
        // 	'id' => 1,
        // 	'is_private' => 0,//$faker->biasedNumberBetween($min = 0, $max = 1),
        // 	'password' => bcrypt('secret'), //bcrypt(str_random(10))
        // 	'description' => '',
        // 	'title' => '',
        //     'img_url' => '',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        //     //dont know if we need created at or deleted at or laravel takes care of it
        // ]);
    }
}
