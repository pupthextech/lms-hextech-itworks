<?php

namespace App\Http\Controllers\Admin\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Book;

class Authors extends Controller
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
        $data['authorList'] = Book\AuthorsModel::all();

        // set active page on the sidebar
        $data['active_page'] = 'adminauthors';
        $data['title'] = 'Authors';
        return view('admin.authors.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->verifyRole(Auth::user()->role);
        $data['authorList'] = Book\AuthorsModel::all();

        // set active page on the sidebar
        $data['active_page'] = 'adminauthors';
        $data['title'] = 'Add Author';
        return view('admin.authors.create', $data);
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
            'name' => ['unique:book_authors', 'required'],
        ]);
    
        $newData = [
            'name' => $request->name,
            'status' => 'Enable',
        ];
        // save data to database
        Book\AuthorsModel::create($newData);
     
        return redirect()->route('authors.index')
                        ->with('success','Author added successfully.');
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
        $this->verifyRole(Auth::user()->role);
        //
        $data['author'] = Book\AuthorsModel::find($id);
        $data['active_page'] = 'adminauthors';
        $data['title'] = 'Edit Author';
        return view('admin.authors.edit',$data);
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
            'name' => ['unique:book_authors', 'required'],
        ]);
    
        $newData = [
            'name' => $request->name,
            'status' => 'Enable',
        ];
        // find book in database and update
        $author = Book\AuthorsModel::find($id);
        $author->update($newData);
    
        return redirect()->route('authors.index')
                        ->with('success','Author updated successfully');
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
        $author = Book\AuthorsModel::find($id);
        $author->delete();
    
        return redirect()->route('authors.index')
                        ->with('success','Author deleted successfully');
    }
}
