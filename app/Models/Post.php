<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Vote;

class Post extends Model
{
	use SoftDeletes;
    //for softdeleting
    protected $dates = ['deleted_at'];

    protected $table = 'posts';

    public static  $rules = [
            // 'img_url' => 'required',
            'input' => 'required'
        ];

    public function user(){
    	return $this->belongsTo('App\User', 'owner_id' , 'id');
    }

    public function group(){
        return $this->belongsTo('App\Models\UserGroup', 'group_id','id' );
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public static function calculateVoteScore()
    {
        $posts = self::all();
        foreach ($posts as $post) {
            $post->vote_score = $post->voteScore();
            //assing likes and dislikes for the post
            $post->likes = $post->upvotes->count();
            $post->dislikes = $post->downvotes->count();

            $post->save();
        }
    }
   
    public function upvotes()
    {
        return $this->votes()->where('vote', '=', 1);
    }

    public function downvotes()
    {
        return $this->votes()->where('vote', '=', -1);
    }

    public function voteScore()
    {
        // find total upvotes
        $upvotes = $this->upvotes()->count();
        // find total downvotes
        $downvotes = $this->downvotes()->count();
        // return upvotes - downvotes
        return $upvotes - $downvotes;
    }

     public function getCreatedAtAttribute($value)
    {
        $utc = \Carbon\Carbon::createFromFormat($this->getDateFormat(), $value);
        return $utc->setTimezone('America/Chicago')->diffForHumans();
    }
    


}
