<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat data dummy produk
        Product::create([
            'name' => 'Product 1',
            'description' => 'Deskripsi produk 1',
            'price' => 100000,
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'Deskripsi produk 2',
            'price' => 150000,
        ]);

        Product::create([
            'name' => 'Product 3',
            'description' => 'Deskripsi produk 3',
            'price' => 200000,
        ]);
    }
}
