<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Invoice;
use App\Models\Keranjang;
use App\Models\Product;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $posts = Product::latest()->filter()->get();
        $pesanan = Keranjang::all();
        $totalHarga = $pesanan->sum('subtotal');        

        $diskon = ($pesanan->sum('qty') > 8) ? 0.05 * $totalHarga : 0;
        return view('menu', compact('posts', 'pesanan', 'totalHarga', 'diskon'));
    }


    public function store(Request $request, $kode_produk)
    {
        $product = Product::where('kode_produk', $kode_produk)->first();

        $validate = $request->validate([
            'qty' => 'required',
        ]);
        $qty = $validate['qty'];
        $harga = $product->harga * $qty;

        $post = new Keranjang();
        $post->kode_produk = $kode_produk;
        $post->qty = $validate['qty'];
        $post->subtotal = $harga;
        $post->save();

        if ($product) {
            $product->stok -= $qty;
            $product->save();
        }

        return redirect(route('index'));
    }

    public function destroy($id)
    {
        $pesanan = Keranjang::find($id);
        $product = Product::where('kode_produk', $pesanan->kode_produk)->first();
        if ($product) {
            $product->stok += $pesanan->qty;
            $product->save();
        }

        $pesanan->delete();

        return redirect(route('index'));
    }

    public function addPesanan()
    {
        $post = Keranjang::all();
        $jumlah_total = $post->sum('qty');
        $total_harga = $post->sum('subtotal');
        if ($post->isEmpty()) {
            return redirect(route('index'))->with([
                'message' => 'Data tidak boleh kosong',
            ]);
        }

        $diskon = ($post->sum('qty') > 8) ? 0.05 * $total_harga : 0;
        $no_invoice = Carbon::now()->format('Ymd') . rand(111111, 999999);

        $invoice = new Transaksi();
        $invoice->no_invoice = $no_invoice;
        $invoice->jml_produk = $jumlah_total;
        $invoice->total_harga = ($diskon > 0) ? $total_harga - $diskon : $total_harga;
        $invoice->save();


        foreach ($post as $item) {
            $detail = new DetailTransaksi();
            $detail->kode_produk = $item->kode_produk;
            $detail->no_invoice = $no_invoice;
            $detail->qty = $item->qty;
            $detail->subtotal = $item->subtotal;
            $detail->save();
        }

        Keranjang::truncate();

        return redirect(route('struk', $invoice->no_invoice));
    }

    public function struk($no_invoice) {
        $struk = Transaksi::find($no_invoice);
        $det = DetailTransaksi::where('no_invoice', $no_invoice)->get();
        $sum = $det->sum('subtotal');
        $diskon = ($det->sum('qty') > 8) ? 0.05 * $sum : 0;

        return view('struk', compact('struk', 'sum', 'diskon'));
    }

    
}
