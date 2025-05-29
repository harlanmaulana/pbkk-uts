<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Authors extends Model
{
    use HasFactory;

    protected $primaryKey = 'author_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'author_id',
        'name',
        'nationality',
        'birthdate',
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

    public function books()
    {
        return $this->belongsToMany(Books::class, 'book_authors', 'author_id', 'book_id');
    }
}
