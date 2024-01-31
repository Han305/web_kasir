<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="mx-3 my-3">
        <div class="mx-2 d-flex justify-content-between mb-4">
            <div class="d-flex">
                <img src="{{ asset('img/logo.png') }}" alt="" width="36" height="36">
                <h5 class="pt-2 px-2">
                    Jubel Mart
                </h5>
            </div>
            <div class="d-flex">
                <a href="{{ route('produk') }}" class="btn btn-primary me-4">Kelola Produk</a>
                <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
            </div>
        </div>
        @error('message')
            <div class="alert alert-danger small py-3">
                {{ $message }}
            </div>
        @enderror
        @if (session('message'))
            <div class="alert alert-success small py-3">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="row ms-1">
                    @foreach ($posts as $item)
                        <div class="col-6">
                            <div class="card overflow-hidden mb-4" style="width: 23rem;">
                                <img src="{{ asset('img/' . $item->image) }}" alt="" height="200">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                    <p>Rp. {{ $item->harga }}</p>
                                    <p class="text-secondary fst-italic">Stok: {{ $item->stok }}</p>
                                    <form action="{{ route('store', $item->kode_produk) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="nama_produk" value="{{ $item->nama_produk }}">
                                        <input type="hidden" name="harga" value="{{ $item->harga }}">
                                        <div class="d-flex">
                                            <input type="number" class="form-control w-75 me-2" name="qty"
                                                min="0" id="">
                                            <button class="btn btn-success"><i
                                                    class="bi bi-cart-plus-fill"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card h-100" style="width: 33rem;">
                <div class="px-2 py-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($pesanan as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->products->nama_produk }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp. {{ number_format($item->subtotal, 3, '.', '.') }}</td>
                                    <td>
                                        <a href="/hapus/{{ $item->id }}"
                                            class="text-decoration-none text-danger">x</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="py-3">
                        <div class="d-flex justify-content-end">
                            <p class="text-secondary">
                                Diskon: @if ($diskon > 0)
                                    5%
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <h5 class="text-success">Total Harga: Rp.
                                @if ($totalHarga > 0)
                                    {{ number_format($totalHarga - $diskon, 3, '.', '.') }}
                                @else
                                    0
                                @endif
                            </h5>
                        </div>
                        @if (session('pesan'))
                            <div class="text-dark">
                                <p>
                                    {{ session('pesan') }}
                                </p>
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('tambah') }}" method="POST">
                        @csrf
                        <button class="btn mb-2 btn-success w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
