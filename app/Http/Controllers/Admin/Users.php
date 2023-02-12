<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;   

class Users extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    private function verifyRole($role) {
        if($role != 'admin') {
            abort(401);
        }
    }

    public function index() {
        $this->verifyRole(Auth::user()->role);
        $data['userList'] = User::where('role', '!=', 'admin')->get();

        // set active page on the sidebar
        $data['active_page'] = 'users';
        $data['title'] = 'Users';
        return view('admin.users.index', $data);
    }
}
