<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_invoice';

    protected $fillable = [
        'no_invoice',
        'kode_produk',
        'jml_produk',
        'total_harga',
    ];

    protected function detail_transaksis() {
        return $this->hasMany(DetailTransaksi::class, 'no_invoice');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
