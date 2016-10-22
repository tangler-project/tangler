<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
     protected $table = 'groups';

     public static  $rules = [
            'title' => 'required',
            'img_url' => 'required',
            'description' => 'required',
        ];

}
