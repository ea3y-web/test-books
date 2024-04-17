<?php

namespace App\Models;

use App\Enums\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'publisher',
        'author',
        'genre',
        'publication_date',
        'words_number',
        'price'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'genre' => Genre::class,
        'publication_date' => 'date:Y-m-d',
        'price' => 'decimal:2'
    ];
}
