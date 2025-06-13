<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // importe o trait

class Cart extends Model
{
    use HasFactory; // use o trait HasFactory aqui

    protected $fillable = ['user_id'];

    public $incrementing = false; // UUID não incrementa automaticamente
    protected $keyType = 'string'; // chave primária é string (UUID)

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
