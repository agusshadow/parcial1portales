<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total',
        'status',
        'name',
        'email',
        'payment_method'
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
}
