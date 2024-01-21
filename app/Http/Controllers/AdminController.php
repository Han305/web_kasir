<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function category()
    {
        $posts = Category::all();
        return view('admin.category.index', compact('posts'));
    }

    public function addCategory()
    {
        return view('admin.category.add');
    }

    public function storeCategory(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
        ]);

        $post = new Category();
        $post->nama = $validate['nama'];
        $post->save();

        return redirect(route('admin.category'));
    }

    public function editCategory($id)
    {
        $posts = Category::find($id);
        return view('admin.category.edit', compact('posts'));
    }

    public function updateCategory(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => 'required',
        ]);

        $posts = Category::find($id);
        $posts->nama = $validate['nama'];
        $posts->save();

        return redirect(route('admin.category'));
    }

    public function destroyCategory($id)
    {
        $posts = Category::find($id);
        $posts->delete();
        return redirect(route('admin.category'));
    }

    public function product()
    {
        $posts = Product::all();
        return view('admin.produk.index', compact('posts'));
    }

    public function addProduct()
    {
        $categories = Category::all();
        return view('admin.produk.add', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1024',
            'nama_produk' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'categories_id' => 'required',
        ]);

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $image);

        $post = new Product();
        $post->image = $image;
        $post->nama_produk = $validate['nama_produk'];
        $post->stok = $validate['stok'];
        $post->harga = $validate['harga'];
        $post->categories_id = $validate['categories_id'];
        $post->save();

        return redirect(route('admin.produk'));
    }

    public function editProduct($id)
    {
        $post = Product::find($id);
        $categories = Category::all();
        return view('admin.produk.edit', compact('post', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1024',
            'nama_produk' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'categories_id' => 'required',
        ]);

        $posts = Product::find($id);
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $image);
            $posts->image = $image;
        }
        $posts->nama_produk = $validate['nama_produk'];
        $posts->stok = $validate['stok'];
        $posts->harga = $validate['harga'];
        $posts->categories_id = $validate['categories_id'];
        $posts->save();

        return redirect(route('admin.produk'));
    }

    public function destroyProduct($id) {
        $posts = Product::find($id);

        $imagePath = public_path('img') . '/' . $posts->image;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $posts->delete();

        return redirect(route('admin.produk'));
    }
}
