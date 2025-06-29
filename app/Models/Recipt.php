<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Recipt extends Model
{
    /** @use HasFactory<\Database\Factories\ReciptFactory> */
    use HasFactory;
    protected $table = 'recipts';
    protected $fillable = [
        'total_amount',
        'payment_method',
        'status',
        'products',
    ];

     public $incrementing = false;
    protected $keyType = 'string';

     protected static function booted()
    {
        static::creating(function ($recipt) {
            $recipt->id = (string) Uuid::uuid4();
        });
    }
}
