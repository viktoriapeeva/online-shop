<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'products',
        'total_price',
        'status', // e.g., 'pending', 'completed', 'canceled'
        'shipping_address',
        'payment_method', // e.g., 'credit_card', 'paypal'
    ];
    protected $casts = [
        'total_price' => 'decimal:2',
        'products' => 'array', 
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
