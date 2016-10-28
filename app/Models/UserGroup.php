<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
	use SoftDeletes;
    //for softdeleting
    protected $dates = ['deleted_at'];
    
    protected $table = 'users_groups';


    
}
