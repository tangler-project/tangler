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
	        'img_url' => 'required',
	        'description' => 'required',
	        'password' => 'required'
	    ];


}
