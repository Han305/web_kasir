<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center mt-5">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <h4 class="card-title"><span class="text-danger me-2">|</span>Struk Pesanan</h4>
                <p class="text-muted text-small pt-2">No Struk: {{ $struk->no_invoice }}
                    <br> Tanggal: {{ date('d/m/y') }}
                    <br> Nama Kasir: {{ $struk->user->name }}
                </p>
                <hr>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($struk->detail_transaksis as $item)
                                <tr>
                                    <td>{{ $item->products->nama_produk }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="d-flex justify-content-end">
                    <div class="text-dark">
                        <h4 class="text-dark">Total</h4>
                        <h5 class="text-success">
                            Rp. @if ($sum > 0)
                                {{ number_format($sum - $diskon, 3, ',', '.') }}
                            @endif
                        </h5>
                        <p class="text-secondary">
                            Diskon: @if ($diskon > 0)
                                5%
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        window.print()
        window.onafterprint = function() {
            window.location.href = '{{ route('index') }}';
        };
    </script>
</body>

</html>
