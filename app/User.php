<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'verifyToken', 'birthday', 'gender', 'first_name_key', 'last_name_key', 'full_name_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function friend_user(){
        return $this->hasMany('App\Friend', 'friend_user_id');
    }

    public function friend(){
        return $this->hasMany('App\Friend', 'user_id');
    }

    public function comment(){
        return $this->hasMany('App\Comment');
    }

    public function partisipant(){
        return $this->hasMany('App\Partisipant');
    }

    public function discussion(){
        return $this->hasMany('App\Discussion');
    }

    public function disc_comment(){
        return $this->hasMany('App\AdventureComment');   
    }
}
