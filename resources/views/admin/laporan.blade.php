@extends('template.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">                
                <table class="table table-bordered">                    
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Invoice</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Harga</th>                            
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($posts as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>                                
                                <td>{{ $item->no_invoice }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Rp. {{ $item->subtotal }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Barang keluar: {{ $totalQty }}</td>
                            <td>Pendapatan: Rp. {{ number_format($total, 3, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection