<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'category', 'book_id', 'total_copies', 'available_copies',
        'publisher_name', 'published_year', 'cover',
    ];
}
