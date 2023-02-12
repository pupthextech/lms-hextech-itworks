<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book\BooksModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookIssuesModel extends Model
{
    use HasFactory;
    protected $table = 'book_issues';
    public $timestamps = false;
    protected $dates = ['expected_return_date', 'return_date', 'date_issued'];

    protected $fillable = [
        'book_isbn',
        'student_number',
        'expected_return_date',
        'return_date',
        'book_issue_status',
    ];

    public function books(): BelongsTo
    {
        return $this->belongsTo(BooksModel::class,'book_isbn','book_isbn');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class,'student_number','stud_number');
    }
}
