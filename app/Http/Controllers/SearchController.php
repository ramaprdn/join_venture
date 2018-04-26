<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use App\Adventure;

class SearchController extends Controller
{
    public function search(Request $request){
    	$search_string = $request->q;
    	$query = preg_replace('/[^\p{L}\p{N}\s]/u', '', $request->q);
    	$query = Metaphone::metaphoneIndo($query);
    	
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

    public function searchAdventure(Request $request){
        $adventures = Adventure::with('destination')
            ->join('destinations', 'adventure_id', '=', 'adventures.id')
            ->where('name', 'like' , '%'.$request->search. '%')
            ->orWhere('name_key', 'like' , '%'.$request->q. '%')    
            ->orWhere('description', 'like', '%'.$request->search. '%')
            ->orWhere('full_location', 'like', '%'.$request->search. '%')
            ->select('adventures.*')
            ->distinct()
            ->get();
        // return $adventures;
        return view('ajax.search.adventure', compact('adventures'));
    }
}
