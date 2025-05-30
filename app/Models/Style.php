<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Style extends Model
{
    use HasFactory;
    protected $table = 'styles';
    protected $fillable = [
        'name',
        'description',


    ];
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($style) {
            $style->id = (string) Uuid::uuid4();
        });
    }

}
