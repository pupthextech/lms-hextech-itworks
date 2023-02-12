<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UserProfile;
use App\Http\Controllers\Admin\Books;
use App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Admin\BookIssues;
use App\Http\Controllers\Students;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication
Route::get('/',  [Auth\Login::class, 'index'])->name('login');
Route::post('/login/verify', [Auth\Login::class, 'verifyLogin']);
Route::get('/register',  [Auth\Register::class, 'index']);
Route::post('/verifyReg', [Auth\Register::class, 'verify']);
Route::get('/logout', [Auth\Login::class, 'logout']);

Route::get('dashboard', [Dashboard::class, 'index']);

// User profile
Route::get('profile/{id}', [UserProfile::class, 'index']);
Route::post('profile/update', [UserProfile::class, 'update']);

// Admin Books
Route::resource('admin/books', Books\Books::class);
// Admin Book Genres
Route::resource('admin/authors', Books\Authors::class);
Route::resource('admin/categories', Books\Categories::class);

Route::controller(Users::class)->group(function() {
    Route::get('admin/users', 'index');
});

Route::controller(BookIssues::class)->group(function() {
    Route::get('admin/book_issues', 'index');
    Route::get('admin/book_issues/issue', 'issue');
    Route::post('book_issues/placeIssue', 'placeIssue');
    Route::get('admin/book_issues/details/{id}', 'details');
    Route::get('book_issues/return/{id}', 'returnBook');
});

Route::controller(Students::class)->group(function() {
    Route::get('issued_books', 'issuedBooks');
    Route::get('booklist', 'searchBooks');
});