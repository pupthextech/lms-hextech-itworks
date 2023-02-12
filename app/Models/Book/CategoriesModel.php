<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesModel extends Model
{
    use HasFactory;
    protected $table = 'book_categories';
    public $timestamps = true;
    protected $fillable = [
        'category_name',
        'category_status'
    ];
}
