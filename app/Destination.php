<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    public function adventure(){
    	return $this->belongsTo('App\Adventure');
    }
}
