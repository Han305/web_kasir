<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function category() {
        $posts = Category::all();
        return view('admin.category.index', compact('posts'));
    }

    public function addCategory() {
        return view('admin.category.add');
    }

    public function storeCategory(Request $request) {
        $validate = $request->validate([
            'nama' => 'required',
        ]);

        $post = new Category();
        $post->nama = $validate['nama'];
        $post->save();

        return redirect(route('admin.category'));
    }

    public function editCategory($id) {
        $posts = Category::find($id);
        return view('admin.category.edit', compact('posts'));
    }

    public function updateCategory(Request $request, $id) {
        $validate = $request->validate([
            'nama' => 'required',
        ]);

        $posts = Category::find($id);
        $posts->nama = $validate['nama'];
        $posts->save();

        return redirect(route('admin.category'));
    }

    public function destroyCategory($id) {
        $posts = Category::find($id);
        $posts->delete();
        return redirect(route('admin.category'));
    }

    public function produk() {
        return view('admin.produk.index');
    }
}
