<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    // Table name
    protected $table = 'books';

    // Primary key settings
    protected $primaryKey = 'book_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Mass assignable attributes
    protected $fillable = [
        'book_id',
        'title',
        'isbn',
        'publisher',
        'year_published',
        'stock',
    ];
}
