<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gender;
use App\Models\Platform;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'gender_id',
        'platform_id',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    /**
     * Obtiene los items de carrito que contienen este producto
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
