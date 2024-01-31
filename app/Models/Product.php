<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_produk';
    protected $guarded = 'kode_produk';

    protected function keranjangs() {
        return $this->hasMany(Keranjang::class);
    }
}
