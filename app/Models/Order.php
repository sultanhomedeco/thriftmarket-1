<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'product_id',
        'total_price',
        'status',
        'shipping_address',
        'payment_method',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the buyer of this order
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Get the product in this order
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope to get orders by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
