<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'nama_produk' => 'Raket',
            'gambar' => 'raket.png',
            'harga_beli' => 1250000,
            'harga_jual' => 1625000,
            'stok' => 120,
            'category_id' => 1
        ]);
    }
}
