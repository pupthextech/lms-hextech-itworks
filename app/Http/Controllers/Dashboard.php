<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Book;
use App\Models\BookIssuesModel;

class Dashboard extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        if(Auth::user()->role == "student") {
            $data['books'] = Book\BooksModel::where('status', 'Enable')->count();
            $data['issued_books'] = BookIssuesModel::where('student_number', Auth::user()->stud_number)->count();
            $data['to_return'] = BookIssuesModel::whereNull('return_date')->where('student_number', Auth::user()->stud_number)->count();

            $data['active_page'] = 'dashboard';
            $data['title'] = 'Dashboard';
            return view('student.dashboard', $data);
        }
        else {
            $data['books'] = Book\BooksModel::where('status', 'Enable')->count();
            $data['authors'] = Book\AuthorsModel::count();
            $data['categories'] = Book\CategoriesModel::count();
            $data['issued_books'] = BookIssuesModel::count();
            $data['to_return'] = BookIssuesModel::whereNull('return_date')->count();
            $data['returned'] = BookIssuesModel::whereNotNull('return_date')->count();

            // set active page on the sidebar
            $data['active_page'] = 'dashboard';
            $data['title'] = 'Dashboard';
            return view('admin.dashboard', $data);
        }
    }
}
