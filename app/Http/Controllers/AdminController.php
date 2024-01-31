<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        $posts = User::where('category', 'staff')->count();
        $produk = Product::count('nama_produk');
        $stok = Product::sum('stok');     
        $laporan = DetailTransaksi::sum('subtotal');   
        return view('admin.dashboard', compact('posts', 'produk', 'stok', 'laporan'));
    }    

    public function kelola() {
        $posts = Product::all();
        return view('produk', compact('posts'));       
    }

    public function add()
    {        
        return view('add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1024',
            'nama_produk' => 'required',
            'stok' => 'required',
            'harga' => 'required',            
        ]);

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $image);

        $post = new Product();
        $post->image = $image;
        $post->nama_produk = $validate['nama_produk'];
        $post->stok = $validate['stok'];
        $post->harga = $validate['harga'];        
        $post->save();

        return redirect(route('produk'));
    }

    public function edit($kode_produk)
    {
        $post = Product::find($kode_produk);        
        return view('edit', compact('post'));
    }

    public function update(Request $request, $kode_produk)
    {
        $validate = $request->validate([
            'image' => 'image|mimes:jpg,jpeg,bmp,png|max:1024',
            'nama_produk' => 'required',
            'stok' => 'required',
            'harga' => 'required',            
        ]);

        $posts = Product::find($kode_produk);

            // Hapus terlebih dahulu semua detail transaksi yang merujuk ke produk ini
            // Kalo mau update product tapi error buka dulu komen yang dibawah ini
            // $posts->detailTransaksis()->delete();

            // Dan kalo masih error copas ke model product kode dibawah ke model Product
            // public function detail_transaksis() {
            //     return $this->hasMany(DetailTransaksi::class, 'kode_produk', 'kode_produk');
            // }
            


        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $image);
            $posts->image = $image;
        }
        $posts->nama_produk = $validate['nama_produk'];
        $posts->stok = $validate['stok'];
        $posts->harga = $validate['harga'];        
        $posts->save();

        return redirect(route('produk'));
    }

    public function destroy($kode_produk) {
        $posts = Product::find($kode_produk);

        $imagePath = public_path('img') . '/' . $posts->image;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Hapus terlebih dahulu semua detail transaksi yang merujuk ke produk ini
        // Kalo mau delete product tapi error buka dulu komen yang dibawah ini
        // $posts->detailTransaksis()->delete();

        $posts->delete();

        return redirect(route('produk'));
    }

    public function product()
    {
        $posts = Product::all();
        return view('admin.produk.index', compact('posts'));
    }

    public function addProduct()
    {        
        return view('admin.produk.add');
    }

    public function storeProduct(Request $request)
    {
        $validate = $request->validate([
            'image' => 'image|mimes:jpg,jpeg,bmp,png|max:1024',
            'nama_produk' => 'required',
            'stok' => 'required',
            'harga' => 'required',            
        ]);

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $image);

        $post = new Product();
        $post->image = $image;
        $post->nama_produk = $validate['nama_produk'];
        $post->stok = $validate['stok'];
        $post->harga = $validate['harga'];        
        $post->save();

        return redirect(route('admin.produk'));
    }

    public function editProduct($kode_produk)
    {
        $post = Product::find($kode_produk);        
        return view('admin.produk.edit', compact('post'));
    }

    public function updateProduct(Request $request, $kode_produk)
    {
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1024',
            'nama_produk' => 'required',
            'stok' => 'required',
            'harga' => 'required',            
        ]);

        $posts = Product::find($kode_produk);

        // Hapus terlebih dahulu semua detail transaksi yang merujuk ke produk ini
        // Kalo mau update product tapi error buka dulu komen yang dibawah ini
        // $posts->detailTransaksis()->delete();

        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $image);
            $posts->image = $image;
        }
        $posts->nama_produk = $validate['nama_produk'];
        $posts->stok = $validate['stok'];
        $posts->harga = $validate['harga'];        
        $posts->save();

        return redirect(route('admin.produk'));
    }

    public function destroyProduct($kode_produk) {
        $posts = Product::find($kode_produk);

        $imagePath = public_path('img') . '/' . $posts->image;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Hapus terlebih dahulu semua detail transaksi yang merujuk ke produk ini
        // Kalo mau delete product tapi error buka dulu komen yang dibawah ini
        // $posts->detailTransaksis()->delete();

        $posts->delete();

        return redirect(route('admin.produk'));
    }

    public function operator() {
        $posts = User::where('category', 'staff')->get();
        return view('admin.operator.index', compact('posts'));
    }

    public function operatorAdd() {
        return view('admin.operator.add');
    }

    public function operatorStore(Request $request) {
        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'category' => 'required',
        ]);

        $posts = new User();
        $posts->name = $validate['name'];
        $posts->username = $validate['username'];
        $posts->email = $validate['email'];
        $posts->password = $validate['password'];
        $posts->category = $validate['category'];
        $posts->save();

        return redirect(route('admin.operator'));
    }

    public function operatorEdit($id) {
        $posts = User::find($id);
        return view('admin.operator.edit', compact('posts'));
    }

    public function operatorUpdate(Request $request, $id) {
        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'category' => 'required',
        ]);

        $posts = User::find($id);        
        $posts->name = $validate['name'];
        $posts->username = $validate['username'];
        $posts->email = $validate['email'];
        $posts->password = $validate['password'];
        $posts->category = $validate['category'];
        $posts->save();

        return redirect(route('admin.operator'));
    }

    public function operatorDelete($id) {
        $posts = User::find($id);
        $posts->delete();
        return redirect(route('admin.operator'));
    }

    public function laporan() {
        $posts = DetailTransaksi::all();
        $totalQty = $posts->sum('qty');
        $total = $posts->sum('subtotal');
        
        return view('admin.laporan', compact('posts', 'totalQty', 'total'));
    }    
}
