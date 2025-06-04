<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'name',
        'email',
    ];

    /**
     * Relación con el usuario que realizó la orden
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con los items de la orden
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Obtener los productos asociados a esta orden
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    /**
     * Relación con el pago de la orden (uno a uno)
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
