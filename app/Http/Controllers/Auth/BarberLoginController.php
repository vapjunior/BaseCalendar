<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class BarberLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:barber');
    }

    public function showLoginForm()
    {
      return view('auth.barber-login');
    }

    public function login(Request $request)
    {
      $this->validate($request, [
        'phone'     => 'required|max:11',
        'password'  => 'required|min:6'
      ]);

      if (Auth::guard('barber')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->remember))
      {
        return redirect()->intended(route('barber.dashboard'));
      }

      return redirect()->back()->withInput($request->only('phone','remember'));
    }
}
