@extends('template.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Produk</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.produk.add') }}" class="btn btn-primary mb-3">Tambah Produk</a>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($posts as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img src="{{ asset('img/' . $item->image) }}" alt="" style="width: 100px;"></td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->categories_id }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>
                                    <a href="{{ route('admin.produk.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.produk.destroy', $item->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return deleteConfirm()">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        function deleteConfirm() {
            let approve = confirm('Apakah anda yakin ingin menghapus data?');
            return approve;
        }
    </script>
@endsection