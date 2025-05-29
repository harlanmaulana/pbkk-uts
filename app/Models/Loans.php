<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Loans extends Model
{
    use HasFactory;

    protected $primaryKey = 'loan_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['loan_id', 'user_id', 'book_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->loan_id)) {
                $model->loan_id = (string) Str::ulid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(Users1::class, 'user_id', 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id', 'book_id');
    }
}
