<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Biar semua kolom bisa diisi sekaligus tanpa diblokir Laravel
    protected $guarded = ['id']; 

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
