<?php

namespace App\Http\Controllers\Admin\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Book;

class Books extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    private function verifyRole($role) {
        if($role != 'admin') {
            abort(401);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->verifyRole(Auth::user()->role);
        $data['bookList'] = Book\BooksModel::all();

        // set active page on the sidebar
        $data['active_page'] = 'adminbooks';
        $data['title'] = 'Books';
        return view('admin.books.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->verifyRole(Auth::user()->role);
        //
        $data['categories'] = Book\CategoriesModel::latest()->get();
        $data['authors'] = Book\AuthorsModel::latest()->get();
        // dd($data);
        $data['active_page'] = 'adminbooks';
        $data['title'] = 'Add Books';
        return view('admin.books.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->verifyRole(Auth::user()->role);
        // dd($request);
        // validate user input
        $request->validate([
            'book_name' => ['unique:books', 'required'],
            'book_isbn' => ['numeric', 'required'],
            'author_id' => ['numeric', 'required'],
            'category_id' => ['numeric', 'required'],
            'book_copy' => ['numeric', 'required'],
        ]);
    
        // save data to database
        Book\BooksModel::create($request->all());
     
        return redirect()->route('books.index')
                        ->with('success','Book added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
