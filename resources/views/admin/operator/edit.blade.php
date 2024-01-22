@extends('template.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Kategori</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.operator.update', ['id' => $posts->id]) }}" method="POST">                    
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" value="{{ old('name', $posts->name) }}" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="{{ old('name', $posts->username) }}" name="username">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ old('name', $posts->email) }}" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <input type="hidden" name="category" value="staff">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.operator') }}" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </section>
    </div>
@endsection
