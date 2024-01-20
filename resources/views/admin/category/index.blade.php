@extends('template.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kategori</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.category.add') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($posts as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <a href="{{ route('admin.category.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.category.destroy', $item->id) }}" class="btn btn-danger btn-sm"
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
