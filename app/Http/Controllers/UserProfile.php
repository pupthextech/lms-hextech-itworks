<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;
use File;
use App\Models\BookIssuesModel;

class UserProfile extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data['issueCounts'] = BookIssuesModel::where('student_number', Auth::user()->stud_number)->count();

        $data['active_page'] = 'userProfile';
        $data['title'] = 'User Profile';
        if(Auth::user()->role == 'admin')
            $data['layout'] = 'layout';
        else 
            $data['layout'] = 'student.layout';
        return view('user_profile', $data);
    }

    public function update(Request $request) {
        // Validate user request
        $request->validate([
            'stud_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'confpassword' => ['required_with:password'],
        ]);

        // get authenticated user data
        $user = User::where('stud_number', Auth::user()->stud_number)->first();

        // check if password correct
        if($request->password != NULL) {
            if(!Hash::check($request->password, $user->password)) {
                return back()->with("error", "Old Password Doesn't match!");
            } else {
                $user->password = Hash::make($request->new_password);
            }
        }
        
        if($request->hasFile('image')){
            // if user profile update also with image 
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            
            $filePath = public_path('uploads/profile/'.$user->image);
            if(File::exists($filePath)){
                File::delete($filePath);
            }else{
                $fileName = $request->stud_number.'.'.$request->image->extension();  
                $request->image->move(public_path('uploads/profile'), $fileName);
                $user->image = $fileName;
            }
            $user->save();
            return back()->with('success', '<strong>Success!</strong> Your profile is now updated.');
        } else {
            // if user profile update also without image
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->update();
        }

        return back()->with('success', '<strong>Success!</strong> Your profile is now updated.');
    }
}
