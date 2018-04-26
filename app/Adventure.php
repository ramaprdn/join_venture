<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adventure extends Model
{
    public function destination(){
    	return $this->hasMany('App\Destination');
    }

}
