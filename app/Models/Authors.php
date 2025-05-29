<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Authors extends Model
{
    use HasFactory;

    // Primary key settings
    protected $primaryKey = 'author_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Mass assignable attributes
    protected $fillable = [
        'author_id',
        'name',
        'nationality',
        'birthdate',
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
    public function books()
    {
        return $this->belongsToMany(Books::class, 'book_authors', 'author_id', 'book_id');
    }
}
