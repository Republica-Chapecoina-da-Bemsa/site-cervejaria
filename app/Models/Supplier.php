<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
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
