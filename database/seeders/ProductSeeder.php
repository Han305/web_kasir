<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'image' => 'image.png',
            'nama_produk' => 'ayam bakar',
            'harga' => '15.000',
        ]);
        DB::table('products')->insert([
            'image' => 'image.png',
            'nama_produk' => 'ayam bakar',
            'harga' => '15.000',
        ]);
        DB::table('products')->insert([
            'image' => 'image.png',
            'nama_produk' => 'ayam bakar',
            'harga' => '15.000',
        ]);
        DB::table('products')->insert([
            'image' => 'image.png',
            'nama_produk' => 'ayam bakar',
            'harga' => '15.000',
        ]);

    }
}
