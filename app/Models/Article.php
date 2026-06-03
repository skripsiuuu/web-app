<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Buka gerbang biar semua kolom bisa diisi sekaligus
    protected $guarded = ['id'];
}