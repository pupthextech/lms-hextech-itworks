<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class Register extends Controller
{
    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {
        return view('auth/register');
    }

    public function verify(Request $request) {
        $request->validate([
            'stud_number' => 'unique:users',
            'email' => 'unique:users',
            'image' => ['required', 'mimes:jpeg,png,jpg'],
        ],
        [
            'stud_number.unique' => 'Student number currently registered.',
            'email.unique' => 'E-mail currently registered.',
            'image.required' => 'Please upload an image.',
            'image.mimes' => 'Uploaded file is not an image.'
        ]);

        $data = $request->all();

        $fileName = $data['stud_number'].'.'.$request->image->extension();  
        $request->image->move(public_path('uploads/profile'), $fileName);
        
        User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role' => 'student',
            'gender' => $data['gender'],
            'image' => $fileName,
            'stud_number' => $data['stud_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect('/')->with('success','Account created successfully!');
    }
}
