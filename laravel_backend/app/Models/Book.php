<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'ISBN',
        'image',
        'title',
        'author',
        'category',
        'publication_year',
        'available_copies',
    ];
}
