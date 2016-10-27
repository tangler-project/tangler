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
	        // 'img_url' => 'required',
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

}
