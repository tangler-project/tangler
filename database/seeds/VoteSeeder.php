<?php

use Illuminate\Database\Seeder;

use App\Models\Post;
use App\Models\Vote;
use App\User;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        $users = User::all();
        // dd($post);
        foreach ($posts as  $post) {
        	$vote = new Vote();
        	foreach ($users as  $user) {

	        	$vote->user_id = $user->id;
	        	$vote->post_id = $post->id;

	        	$randomNum=0;
	        	while($randomNum != 1 && $randomNum != -1){
	        		$randomNum = mt_rand(-1,1);
	        	}
	        	$vote->vote = $randomNum;

	        	$vote->save();
        	}
        }

        Post::calculateVoteScore();
    }
}
