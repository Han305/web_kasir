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
                <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">                    
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="text" class="form-control" name="stok">
                    </div>                    
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.produk') }}" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </section>
    </div>
@endsection
