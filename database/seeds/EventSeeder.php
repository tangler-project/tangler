<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\Event::class, 25)->create();
        DB::table('events')->insert([
        	'id' => 1,
            'img_url' => '',
            'title' => '',
	        'content' => '',
            'owner_id' => 1, //App\User::all()->random()->id
            'group_id' => 1, //App\Models\Group::all()->random()->id
            //dont know if we need created at.. or laravel takes care of it
        ]);
    }
}
