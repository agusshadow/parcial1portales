<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price'
    ];

    /**
     * Obtiene el carrito al que pertenece este item
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Obtiene el producto asociado a este item
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calcular el subtotal de este item (precio * cantidad)
     */
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}
