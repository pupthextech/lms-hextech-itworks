<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;

class Login extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function index() {
        return view('auth/login');
    }
    
    public function verifyLogin(Request $request) {
        $credentials = $request->only('stud_number', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Successfully Logged In!');
        }
  
        return redirect("/")->withError('Error, invalid credentials');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return redirect('/')->withSuccess('Successfully Logged Out!');;
    }
}
