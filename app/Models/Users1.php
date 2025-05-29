<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Users1 extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'users1';

    // Primary key settings
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'membership_date',
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
    public function loans()
    {
        return $this->hasMany(Loans::class, 'user_id', 'user_id');
    }
}
