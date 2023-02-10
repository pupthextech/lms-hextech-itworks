<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'genre_id',
        'status',
    ];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genres::class,'genre_id','id');
    }
}
