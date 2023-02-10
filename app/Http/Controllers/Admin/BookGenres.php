<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Genres as GenreModel;

class BookGenres extends Controller
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
        $data['genreList'] = GenreModel::all();

        // set active page on the sidebar
        $data['active_page'] = 'admingenrebooks';
        return view('admin.books.genre.index', $data);
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
        $data['active_page'] = 'admingenrebooks';
        return view('admin.books.genre.create', $data);
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
            'name' => ['unique:genres', 'required']
        ]);
    
        // save book to database
        GenreModel::create($request->all());
     
        return redirect()->route('genre.books.index')
                        ->with('success','Genre added successfully.');
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
        //
        $data['genre'] = GenreModel::find($id);
        $data['active_page'] = 'admingenrebooks';
        return view('admin.books.genre.edit',$data);
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
            'name' => ['unique:genres', 'required']
        ]);
    
        // find book in database and update
        $book = GenreModel::find($id);
        $book->update($request->all());
    
        return redirect()->route('genre.books.index')
                        ->with('success','Genre updated successfully.');
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
        //
        $genre = GenreModel::find($id);
        $genre->delete();
    
        return redirect()->route('genre.books.index')
                        ->with('success','Genre deleted successfully');
    }
}
