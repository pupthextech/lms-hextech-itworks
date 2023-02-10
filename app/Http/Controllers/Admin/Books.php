<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books as BookModel;
use App\Models\Genres as GenreModel;
use Auth;

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
        $data['bookList'] = BookModel::all();

        // set active page on the sidebar
        $data['active_page'] = 'adminbooks';
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
        // set active page on the sidebar
        $data['active_page'] = 'adminbooks';
        $data['genres'] = GenreModel::latest()->get();
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
        // validate user input
        $request->validate([
            'title' => ['unique:books', 'required'],
            'isbn' => ['required'],
            'author' => ['required'],
        ]);
    
        // save book to database
        BookModel::create($request->all());
     
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
        $this->verifyRole(Auth::user()->role);
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
        $this->verifyRole(Auth::user()->role);
        $data['book'] = BookModel::find($id);
        $data['active_page'] = 'adminbooks';
        return view('admin.books.edit',$data);
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
        $this->verifyRole(Auth::user()->role);
        // validate user input
        $request->validate([
            'title' => ['unique:books', 'required'],
            'isbn' => ['required'],
            'author' => ['required'],
        ]);
    
        // find book in database and update
        $book = BookModel::find($id);
        $book->update($request->all());
    
        return redirect()->route('books.index')
                        ->with('success','Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->verifyRole(Auth::user()->role);
        $book = BookModel::find($id);
        $book->delete();
    
        return redirect()->route('books.index')
                        ->with('success','Book deleted successfully');
    }
}
