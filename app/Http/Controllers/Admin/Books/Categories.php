<?php

namespace App\Http\Controllers\Admin\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Book;

class categories extends Controller
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
        $data['categoryList'] = Book\CategoriesModel::all();

        // set active page on the sidebar
        $data['active_page'] = 'admincategories';
        $data['title'] = 'Categories';
        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->verifyRole(Auth::user()->role);
        $data['categoryList'] = Book\CategoriesModel::all();

        // set active page on the sidebar
        $data['active_page'] = 'admincategories';
        $data['title'] = 'Add Category';
        return view('admin.categories.create', $data);
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
            'category_name' => ['unique:book_categories', 'required'],
        ]);
    
        $newData = [
            'category_name' => $request->category_name,
            'category_status' => 'Enable',
        ];
        // save data to database
        Book\CategoriesModel::create($newData);
     
        return redirect()->route('categories.index')
                        ->with('success','category added successfully.');
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
        $data['category'] = Book\CategoriesModel::find($id);
        $data['active_page'] = 'admincategories';
        $data['title'] = 'Edit category';
        return view('admin.categories.edit',$data);
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
            'category_name' => ['unique:book_categories', 'required'],
        ]);
    
        $newData = [
            'category_name' => $request->category_name,
            'category_status' => 'Enable',
        ];
        // find book in database and update
        $category = Book\CategoriesModel::find($id);
        $category->update($newData);
    
        return redirect()->route('categories.index')
                        ->with('success','category updated successfully');
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
        $category = Book\CategoriesModel::find($id);
        $category->delete();
    
        return redirect()->route('categories.index')
                        ->with('success','category deleted successfully');
    }
}
