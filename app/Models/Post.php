<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    


}
