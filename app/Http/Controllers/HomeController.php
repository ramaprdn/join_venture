<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;
use App\Friend;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_post = DB::table('posts')->join('users', 'user_id', '=', 'users.id')->where('user_id', Auth::user()->id)->select('user_id', 'first_name', 'last_name', 'description', 'posts.created_at');

        $user_friend_post = DB::table('friends')->join('users as user', 'user.id', '=', 'user_id')
            ->join('posts', 'friend_user_id', '=', 'posts.user_id')
            ->join('users as friend', 'friend.id', '=', 'friend_user_id')
            ->where('user.id', Auth::user()->id)
            ->select('friend.id as user_id', 'friend.first_name', 'friend.last_name', 'description', 'posts.created_at')
            ->union($user_post)->orderBy('created_at', 'desc')->get();
        
        // $time = new TimeForHumans;
        // return $time->time_elapsed_string($user_friend_post[0]->created_at);
        return view('user.home', compact('user_friend_post'));
    }
}
