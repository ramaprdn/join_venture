<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class SearchController extends Controller
{
    public function search(Request $query){
    	$search_string = $query->q;
    	$query = preg_replace('/[^\p{L}\p{N}\s]/u', '', $query->q);
    	$query = Metaphone::metaphoneIndo($query);
    	
    	// $query = metaphone($query);
    	// return $query;
    	// $users = DB::table('users')->where('status', '=', 1)
    	// 			->where('id', '<>', Auth::user()->id)
    	// 			->where(function($q) use ($query){
    	// 				$q->orWhere('first_name_key', 'like', '%'.$query. '%')
    	// 				->orWhere('last_name_key', 'like', '%'.$query. '%')
    	// 				->orWhere('full_name_key', 'like', '%'.$query. '%');
    	// 			})
    	// 			->get();
    	return view('search.result', compact('query', 'search_string'));
    }

    public function searchFriendNotFollowed(Request $request){
    	
    	$friendsFromUsersTable = DB::table('users')
    				->whereNotIn('id', function($q){
    					$q->select('friend_user_id')
    						->from('friends')
    						->where('user_id', Auth::user()->id);
    				})
    				->where(function($e) use ($request){
    					$e->orWhere('first_name_key', 'like', '%'.$request->q. '%')
    					->orWhere('last_name_key', 'like', '%'.$request->q. '%')
    					->orWhere('full_name_key', 'like', '%'.$request->q. '%')
    					->orWhere('first_name', 'like', '%'.$request->search. '%')
    					->orWhere('last_name', 'like', '%'.$request->search. '%');
    				})
    				->where('id', '<>', Auth::user()->id)
    				->where('status', 1);

    	$friends = DB::table('friends')
    		->join('users', 'friend_user_id', '=', 'users.id')
    		->where(function($e) use ($request){
				$e->orWhere('first_name_key', 'like', '%'.$request->q. '%')
				->orWhere('last_name_key', 'like', '%'.$request->q. '%')
				->orWhere('full_name_key', 'like', '%'.$request->q. '%')
				->orWhere('first_name', 'like', '%'.$request->search. '%')
				->orWhere('last_name', 'like', '%'.$request->search. '%');
			})
    		->where('user_id', Auth::user()->id)
    		->where('users.status', 1)
    		->where('status_following', 0)
    		->select('users.*')
    		->union($friendsFromUsersTable)
    		->get();

    	return view('ajax.search.unfollowedFriend', compact('friends'));
    }

    public function searchFriendFollowed(Request $request){
    	$friends = DB::table('friends')
    		->join('users', 'friend_user_id', '=', 'users.id')
    		->where(function($e) use ($request){
				$e->orWhere('first_name_key', 'like', '%'.$request->q. '%')
				->orWhere('last_name_key', 'like', '%'.$request->q. '%')
				->orWhere('full_name_key', 'like', '%'.$request->q. '%')
				->orWhere('first_name', 'like', '%'.$request->search. '%')
				->orWhere('last_name', 'like', '%'.$request->search. '%');
			})
    		->where('user_id', Auth::user()->id)
    		->where('users.status', 1)
    		->where('status_following', 1)
    		->select('users.*')
    		->get();
    	return view('ajax.search.followedFriend', compact('friends'));
    }
}
