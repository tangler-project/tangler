<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(GroupSeeder::class);

        $this->call(EventSeeder::class);
        $this->call(PostSeeder::class);

        $this->call(UserGroupSeeder::class);

        $this->call(VoteSeeder::class);

        Model::reguard();
    }
}
