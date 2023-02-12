<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BooksModel extends Model
{
    use HasFactory;
    protected $table = 'books';
    public $timestamps = true;

    protected $fillable = [
        'author_id',
        'category_id',
        'book_name',
        'book_isbn',
        'book_copy',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(AuthorsModel::class,'author_id','id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoriesModel::class,'category_id','id');
    }
}
