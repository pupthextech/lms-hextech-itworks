<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class Dashboard extends Controller
{
    public function index() {
        if(Auth::user()->role == "student") {
            dd('iam studenet');
        }
        else {
            // set active page on the sidebar
            $data['active_page'] = 'dashboard';
            return view('admin.dashboard', $data);
        }
    }
}
