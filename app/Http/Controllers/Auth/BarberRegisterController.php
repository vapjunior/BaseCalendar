<?php

namespace App\Http\Controllers\Auth;

use App\Barber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class BarberRegisterController extends Controller
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
    protected $redirectTo = '/barber';

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
            'email' => 'required|string|email|max:255|unique:barbers',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:60',
            'phone' => 'required|string|max:11',
            'role' => 'required|max:1'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Client
     */
    protected function create(Request $data)
    {
        //dd($data);

        $this->validate($data, [
            'email' => 'required|string|email|max:255|unique:barbers',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:60',
            'phone' => 'required|string|max:20',
            'role' => 'required|max:1'
        ]);

        Barber::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'role' => $data['role']
        ]);

        return redirect()->route('barber.barbers');
    }

    public function showRegistrationForm()
    {
        return view('auth.barber-register');
    }
}
