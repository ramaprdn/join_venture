<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partisipant extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
