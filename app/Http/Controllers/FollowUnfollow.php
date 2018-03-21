<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\User;
use Auth;


class FollowUnfollow extends Controller
{
    public function followFriend($friend_id){
    	$user_login = Auth::user()->id;
    	$friend = new Friend();
    	$friend->user_id = $user_login;
    	$friend->friend_user_id	= $friend_id;
    	$friend->status_following = 1;
    	$friend->save();
    	return 0;
    }

    public function unfollowFriend($friend_id){
    	$friendship_id = Friend::all()->where('user_id', Auth::user()->id)->where('friend_user_id', $friend_id)->first();
    	$friend = Friend::find($friendship_id->id);
    	$friend->status_following = 0;
    	$friend->save();
    	return "sudah di unfollow";
    }
}
