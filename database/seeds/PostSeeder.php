<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\Post::class, 25)->create();
        // DB::table('posts')->insert([
        // 	'id' => 1,
        //     'img_url' => '',
	       //  'content' => '',
        //     'owner_id' => 1, //App\User::all()->random()->id
        //     'group_id' => 1, //App\Models\Group::all()->random()->id
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        //     //dont know if we need created at.. or laravel takes care of it
        // ]);
    }
}
