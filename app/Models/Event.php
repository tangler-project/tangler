<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
	use SoftDeletes;
    //for softdeleting
    protected $dates = ['deleted_at'];
	
    protected $table = 'events';


     public static  $rules = [
            'title' => 'required',
            'img_url' => 'required',
            // 'content' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
        
    public function user(){
        return $this->belongsTo('App\User', 'owner_id' , 'id');
    }

    public function group(){
        return $this->belongsTo('App\Models\UserGroup', 'group_id','id' );
    }
}
