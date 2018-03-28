<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function postimage(){
    	return $this->hasMany('App\Postimage');
    }
}
