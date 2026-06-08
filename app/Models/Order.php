<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'total_price', 
        'status',
        'recipient_name',
        'phone_number',
        'shipping_address',
        'snap_token'
        ];

    // Satu Order punya banyak OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}