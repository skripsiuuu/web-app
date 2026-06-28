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
        'cancel_reason',
        'refund_proof',  
        'shipping_cost',  
        'admin_fee',
        'snap_token'
        ];

    // Satu Order punya banyak OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}