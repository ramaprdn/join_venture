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
    	
        if ($request->hasFile('img_home')) {
            $filenameWithExt = $request->file('img_home')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('img_home')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('img_home')->move(public_path('img/users'), $filenameToStore);
            $user->img_home = $filenameToStore;
        }

        if ($request->hasFile('img_profile')) {
            $filenameWithExtProfile = $request->file('img_profile')->getClientOriginalName();
            $filenameProfile = pathinfo($filenameWithExtProfile, PATHINFO_FILENAME);
            $extensionProfile = $request->file('img_profile')->getClientOriginalExtension();
            $filenameToStoreProfile = $filenameProfile.'_'.time().'.'.$extensionProfile;
            $pathProfile = $request->file('img_profile')->move(public_path('img/users'), $filenameToStoreProfile);
            $user->img_profile = $filenameToStoreProfile;
        }

        $user->save();

    	return redirect(route('profile'));
    }
}
	