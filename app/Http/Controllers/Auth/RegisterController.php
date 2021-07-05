<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('welcome');
    }

    public function register(Request $request){
        $request->validate([
           'fname'=> ['required', 'string', 'max:255'],
           'lname'=> ['required', 'string', 'max:255'],
           'email'=> ['required', 'string', 'email', 'unique:users'],
           'password'=> ['required', 'string', 'min:8', 'confirmed'],
           'day'=> ['required', 'numeric'],
           'month'=> ['required', 'numeric'],
           'year'=> ['required', 'numeric'],
        ]);

        $birthDay = strtotime($request->get('year'). '-' . $request->get('month'). '-' . $request->get('day'));
        $birthDay= date('Y-m-d', $birthDay);


        $userInfo= array();

        $userInfo['fname']= $request->get('fname');
        $userInfo['lname']= $request->get('lname');
        $userInfo['email']= $request->get('email');
        $userInfo['sex']= $request->get('sex')=='male'? 1 : 0;
        $userInfo['password']= bcrypt($request->get('password'));
        $userInfo['b_day']= $birthDay;

        $user= User::create($userInfo);

        Auth::loginUsingId($user->id);

        return redirect()->route('dashboard');


    }

}
