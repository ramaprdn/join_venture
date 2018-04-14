<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Mail;
use App\Mail\verifyEmail;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Metaphone;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // not allow to imidiete login
        // $this->guard()->login($user);

        return redirect(route('login'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'birthday' => 'required',
            'gender' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Session::flash('status', 'Registered! but you need to verify your email to activate your account. Please check your email');
        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'first_name_key' => Metaphone::metaphoneIndo($data['first_name']), 
            'last_name_key' => Metaphone::metaphoneIndo($data['last_name']), 
            'full_name_key' => Metaphone::metaphoneIndo($data['first_name'].$data['last_name']),
            'verifyToken' => Str::random(40),
        ]);
        $thisUser = User::findOrFail($user->id);
        $this->sendEmailVerification($thisUser);
        return $user;
    }

    public function sendEmailVerification($thisUser){
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function verifyEmail(){
        return view('email.verify');
    }

    public function sendEmailDone($token){
        $user = User::where('verifyToken',$token)->first();
        if($user){
            $result = User::where('verifyToken',$token)->update(['status'=>'1', 'verifyToken'=>NULL]);
            if($result == 1){
                Session::flash('status', 'Successfully verify your email');
            }else{
                Session::flash('status', 'Something wrong while verifying your email');
            }
            return redirect(route('login'));
        }else{
            return "user not found";
        }
    }
}
