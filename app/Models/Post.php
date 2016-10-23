<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use SoftDeletes;
    //for softdeleting
    protected $dates = ['deleted_at'];

    protected $table = 'posts';

    public static  $rules = [
            'title' => 'required',
            'img_url' => 'required',
            'content' => 'required'
        ];
}
