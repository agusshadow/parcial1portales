<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'total',
    ];

    /**
     * Relación: un pago pertenece a una orden.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
