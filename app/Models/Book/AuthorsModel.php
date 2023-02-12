<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorsModel extends Model
{
    use HasFactory;
    protected $table = 'book_authors';
    public $timestamps = true;
    
    protected $fillable = ['name', 'status'];

    public function hello() {
        dd('hello there');
    }
}
