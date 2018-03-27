<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\User;
use Auth;

class UserController extends Controller
{
    public function show_profile_view(){
    	$kabupaten = District::all();
    	// return $kabupaten;
    	return view('user.profile', compact('kabupaten'));
    }

    public function update(Request $request){
    	$user = User::find( Auth::user()->id );
    	$user->first_name = $request->first_name;
    	$user->last_name = $request->last_name;
    	$user->email = $request->email;
    	$user->bio = $request->bio;
    	$user->gender = $request->gender;
    	$user->location = $request->kabupaten;
    	$user->save();

    	return redirect(route('profile'));
    }
}
	