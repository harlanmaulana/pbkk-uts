<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books'; // Nama tabel
    protected $primaryKey = 'book_id'; // Primary key yang digunakan
    public $incrementing = false; // Karena ULID/UUID tidak auto increment
    protected $keyType = 'string'; // Karena ULID/UUID bertipe string

    protected $fillable = [
        'book_id',       // Ditambahkan di sini
        'title',
        'isbn',
        'publisher',
        'year_published',
        'stock',
    ];
}
