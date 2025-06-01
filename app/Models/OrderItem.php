<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    /**
     * Relación con la orden a la que pertenece este item
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relación con el producto
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calcular el subtotal del item
     */
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}
