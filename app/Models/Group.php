<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
	use SoftDeletes;
    //for softdeleting
    protected $dates = ['deleted_at'];

	 protected $table = 'groups';

	public static  $rules = [
	        'title' => 'required',
	        'password' => 'required',
	        'confirmPassword' => 'required'
	    ];
	public static  $rulesPublic = [
	        'title' => 'required',
	        
	    ];

	public static $rulesJoinKnot = [
			'name'=> 'required',
			'password' => 'required'
	];
	
	//relation with the pivot table
	public function users()
    {
        return $this->belongsToMany('App\User', 'users_groups');
    }

	public function post(){
    	return $this->hasMany('App\Models\Post', 'group_id','id');
    }

    public function event(){
        return $this->hasMany('App\Models\Event', 'group_id','id' );
    }
    //get random img for groups every time from our bank
    public static function getRandomImg(){
    	return "/img/group-banners/gb".mt_rand(1,22).".jpg";
    }

}
