<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundReport extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_id', 'description', 'proof_image', 'status', 'admin_feedback'];
    
    // Relasi ke User (Laporan ini punya siapa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Order (Laporan ini buat pesanan yang mana)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}