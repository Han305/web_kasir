@extends('template.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Kategori</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.category.update', ['id' => $posts->id]) }}" method="POST">                    
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" value="{{ old('nama', $posts->nama) }}" name="nama">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.category') }}" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </section>
    </div>
@endsection
