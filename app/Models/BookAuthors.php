<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BookAuthors extends Model
{
    use HasFactory;

    protected $table = 'book_authors';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'book_id',
        'author_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::ulid();
            }
        });
    }

    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id');
    }

    public function author()
    {
        return $this->belongsTo(Authors::class, 'author_id');
    }
}
