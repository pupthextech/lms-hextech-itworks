<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book\BooksModel;
use App\Models\BookIssuesModel;
use App\Models\User;
use Auth;   
use Carbon\Carbon;

class BookIssues extends Controller
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
        $data['bookIssueList'] = BookIssuesModel::all();
        $data['user'] = BookIssuesModel::all();

        // set active page on the sidebar
        $data['active_page'] = 'bookIssues';
        $data['title'] = 'Book Issues';
        return view('admin.bookIssues.index', $data);
    }

    public function details($id) {
        $data['issued'] = BookIssuesModel::find($id);
        $data['user'] = User::where('stud_number', $data['issued']->student_number)->first();
        $data['book'] = BooksModel::where('book_isbn', $data['issued']->book_isbn)->first();

        $data['active_page'] = 'bookIssues';
        $data['title'] = 'Book Issue Details';
        return view('admin.bookIssues.details', $data);
    }

    public function issue() {
        $this->verifyRole(Auth::user()->role);
        $data['bookList'] = BooksModel::where('status', '=', 'Enable')->get();
        $data['userList'] = User::where([['status', '=', 'Enable'], ['role', '!=', 'admin']])->get();
        
        // set active page on the sidebar
        $data['active_page'] = 'bookIssues';
        $data['title'] = 'Issue a book';
        return view('admin.bookIssues.issue', $data);
    }

    // public function placeIssue(Request $request) {
    //     $this->verifyRole(Auth::user()->role);
        
    //     $book = BooksModel::where('book_isbn', $request->book_isbn)->first();
    //     $book->decrement('book_copy', 1);

    //     if($book->book_copy < 1) {
    //         $book->status = 'Disabled';
    //         $book->save();
    //     }

    //     $data = [
    //         'book_isbn' => $request->book_isbn,
    //         'student_number' => $request->student_number,
    //         'expected_return_date' => Carbon::now()->addDays(7),
    //     ];

    //     BookIssuesModel::create($data);
    //     return redirect('admin/book_issues')->withSuccess('Placed issue successfully!');
    // }

    public function placeIssue(Request $request) {        
        $book = BooksModel::where('book_isbn', $request->book_isbn)->first();
        $book->decrement('book_copy', 1);

        if($book->book_copy < 1) {
            $book->status = 'Disabled';
            $book->save();
        }

        $data = [
            'book_isbn' => $request->book_isbn,
            'student_number' => Auth::user()->stud_number,
            'expected_return_date' => Carbon::now()->addDays(7),
        ];

        BookIssuesModel::create($data);
        return redirect('booklist')->withSuccess('Placed issue successfully!');
    }

    public function returnBook($id) {        
        // get issued book data
        $issued = BookIssuesModel::find($id); 

        // get book data, and add 1 to the copy
        $book = BooksModel::where('book_isbn', $issued->book_isbn)->first();
        $book->increment('book_copy');
        $book->refresh();

        if($book->book_copy >= 1) {
            $book->status = 'Enable';
            $book->save();
        }

        // add return date and update database.
        $issued->return_date = Carbon::now();
        $issued->book_issue_status = 'Returned';
        $issued->save();

        return redirect('issued_books')->withSuccess('Book returned successfully!');
    }
}
