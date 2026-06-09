<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Bikin akun user default buat login/testing
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // Kalau password ga di-set di sini, biasanya default-nya 'password'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin Mitra Hidup Sehat',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // 2. Panggil data asli lu hasil dari iseed
        $this->call([
            ProductsTableSeeder::class,
            ArticlesTableSeeder::class,
            RecipesTableSeeder::class,
        ]);
        $this->call(ProductsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
    }
}