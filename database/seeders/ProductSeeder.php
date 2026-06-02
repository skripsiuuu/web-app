<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Boneless Paha Cut (Skin On)',
            'slug' => 'boneless-paha-cut',
            'category' => 'Ayam Probiotik',
            'weight' => '900 - 1.000 gram',
            'advantages' => 'Bebas Residu Antibiotik, Bebas Suntik Hormon Pertumbuhan, Bebas Flu Burung, Bebas Formalin',
            'description' => 'Daging paha ayam probiotik tanpa tulang, cocok untuk steak atau memasak praktis.',
            'price' => 76000,
            'image' => 'blpahacuts.jpg', // Nanti tinggal taruh foto paha.jpg di folder public/images
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Paha Bawah / Drumstick',
            'slug' => 'paha-bawah-drumstick',
            'category' => 'Ayam Probiotik',
            'weight' => '900 - 1.000 gram',
            'advantages' => 'Bebas Residu, Kaya Protein, Tanpa Suntik Hormon, Segar Alami',
            'description' => 'Paha bawah ayam segar kaya protein, tanpa antibiotik dan hormon pertumbuhan.',
            'price' => 65500,
            'image' => 'drumsticks.jpg',
            'stock' => 40,
        ]);
    }
}