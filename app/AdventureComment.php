<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdventureComment extends Model
{
    protected $table = 'adv_comments';

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
