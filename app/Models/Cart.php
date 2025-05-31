<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'active'
    ];

    /**
     * Obtiene el usuario al que pertenece este carrito
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene los items del carrito
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Calcular el subtotal del carrito
     */
    public function getSubtotalAttribute()
    {
        return $this->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
    }

    /**
     * Calcular el total
     */
    public function getTotalAttribute()
    {
        return $this->subtotal;
    }
}
