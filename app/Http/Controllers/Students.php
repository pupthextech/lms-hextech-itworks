<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\BookIssuesModel;
use App\Models\Book\BooksModel;

class Students extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function issuedBooks() {
        $data['bookIssues'] = BookIssuesModel::where('student_number', Auth::user()->stud_number)->get();

        // set active page on the sidebar
        $data['active_page'] = 'issuedBooks';
        $data['title'] = 'Manage Issued Books';
        return view('student.issues', $data);
    }

    public function searchBooks() {
        $data['books'] = BooksModel::where('status', '=', 'Enable')->get();

        // set active page on the sidebar
        $data['active_page'] = 'searchBooks';
        $data['title'] = 'Search Available Books';
        return view('student.books', $data);
    }
}
