<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'quantity',
        'product_id',
    ];
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($client) {
            $client->id = (string) Uuid::uuid4();
        });
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
