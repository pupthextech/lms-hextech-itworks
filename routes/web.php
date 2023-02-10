<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UserProfile;
use App\Http\Controllers\Admin\Books;
use App\Http\Controllers\Admin\BookGenres;

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
Route::resource('admin/books', Books::class);
// Admin Book Genres
Route::resource('admin/genre/books', BookGenres::class, [
    'as' => 'genre'
]);
