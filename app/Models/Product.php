<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'style_id',
    ];
    public $incrementing = false;
    protected $keyType = 'string';
    public function style()
    {
        return $this->belongsTo(Style::class, 'style_id');
    }
     protected static function booted()
    {
        static::creating(function ($product) {
            $product->id = (string) Uuid::uuid4();
        });
    }
}
