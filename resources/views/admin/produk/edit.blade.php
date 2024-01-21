@extends('template.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Produk</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.produk.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">                    
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" value="{{ old('nama', $post->nama_produk) }}" name="nama_produk">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="text" class="form-control" value="{{ old('nama', $post->stok) }}" name="stok">
                    </div>
                    <div class="mb-3">
                        <label for="product_category" class="form-label">Kategori Produk</label>
                        <select name="categories_id" id="product_category" class="form-select">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $post->categories_id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>                
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="text" class="form-control" value="{{ old('harga', $post->harga) }}" name="harga">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.produk') }}" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </section>
    </div>
@endsection
