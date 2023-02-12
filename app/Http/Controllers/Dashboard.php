<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class Dashboard extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        if(Auth::user()->role == "student") {
            $data['active_page'] = 'dashboard';
            $data['title'] = 'Dashboard';
            return view('student.dashboard', $data);
        }
        else {
            // set active page on the sidebar
            $data['active_page'] = 'dashboard';
            $data['title'] = 'Dashboard';
            return view('admin.dashboard', $data);
        }
    }
}
