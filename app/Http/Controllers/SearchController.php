<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class SearchController extends Controller
{
    public function searchFriend(Request $query){

    	$query = preg_replace('/[^\p{L}\p{N}\s]/u', '', $query->q);
    	$query = Metaphone::metaphoneIndo($query);
    	// $query = metaphone($query);
    	// return $query;
    	$users = DB::table('users')->where('status', '=', 1)
    				->where('id', '<>', Auth::user()->id)
    				->where(function($q) use ($query){
    					$q->orWhere('first_name_key', 'like', '%'.$query. '%')
    					->orWhere('last_name_key', 'like', '%'.$query. '%')
    					->orWhere('full_name_key', 'like', '%'.$query. '%');
    				})
    				->get();
    	return view('search.result', compact('users'));
    }
}
