<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class BookAuthors extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'book_authors';

    // Primary key settings
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Mass assignable attributes
    protected $fillable = [
        'id',
        'book_id',
        'author_id',
    ];

    // Automatically generate ULID for primary key
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::ulid();
            }
        });
    }

    // Relationships
    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id');
    }

    public function author()
    {
        return $this->belongsTo(Authors::class, 'author_id');
    }
}
