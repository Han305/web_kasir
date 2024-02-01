<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    
    
    protected function products() {
        return $this->belongsTo(Product::class, 'kode_produk');
    }
    
    protected function transaksis() {
        return $this->belongsTo(Transaksi::class, 'no_invoice');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
