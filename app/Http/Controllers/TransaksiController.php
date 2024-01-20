<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index() {
        $posts = Product::all();
        $pesanan = Transaksi::all();
        $totalHarga = $pesanan->sum('harga');

        $diskon = ($pesanan->sum('qty') > 8) ? 0.05 * $totalHarga : 0;
        return view('menu', compact('posts', 'pesanan', 'totalHarga', 'diskon'));
    }
    
    public function store(Request $request) {
        $validate = $request->validate([
            'qty' => 'min:1|required',
            'harga' => 'required',
            'nama_produk' => 'required',
        ]);
        $qty = $validate['qty'];
        $harga = $validate['harga'];

        $sumHarga = $qty * $harga;

        $post = new Transaksi();
        $post->nama_produk = $validate['nama_produk'];
        $post->qty = $validate['qty'];
        $post->harga = $sumHarga;
        $post->save();

        return redirect(route('index'));
    }

    public function destroy($id) {
        $pesanan = Transaksi::find($id);
        $pesanan->delete();
        return redirect(route('index'));
    }

    public function addPesanan() {
        $post = Transaksi::all();
        $nama_produk = $post->pluck('nama_produk')->toArray();
        $jumlah_total = $post->sum('qty');
        $total_harga = $post->sum('harga');        

        $diskon = ($post->sum('qty') > 8) ? 0.05 * $total_harga : 0;
        $no_invoice = 'NV' . Carbon::now()->format('Ymd');

        if ($no_invoice && $nama_produk && $jumlah_total >= 0 && $total_harga >= 0) {            
            $invoice = new Invoice();
            $invoice->no_invoice = $no_invoice;
            $invoice->nama = implode(', ' , $nama_produk);
            $invoice->qty = $jumlah_total;
            $invoice->harga = ($diskon > 0) ? $total_harga - $diskon : $total_harga;
            $invoice->save();

            Transaksi::truncate();

            return redirect(route('index'));
        } else {
            return redirect(route('index'))->with([
                'message' => 'Data tidak boleh kosong',
            ]);
        }
    }
}