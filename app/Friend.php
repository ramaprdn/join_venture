<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function user(){
    	return $this->belongsTo('App\User', 'id');
    }

    public function user_friends(){
    	return $this->belongsTo('App\User', 'friend_user_id');
    }
}
