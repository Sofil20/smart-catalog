@extends('layouts.adminlte')

@section('page-title', 'Barang Masuk')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">
            Daftar Barang Masuk
        </h3>

        <a href="{{ route('stock-transactions.create') }}"
            class="btn btn-success btn-sm">

            <i class="fas fa-plus"></i>

            Tambah Barang Masuk

        </a>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Kode Stock</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Qty Masuk</th>
                        <th>Total Nilai</th>
                        <th>Saldo Akhir</th>

                        @if(auth()->user()->role == 'admin')
                            <th>Merchant</th>
                        @endif

                    </tr>

                </thead>

                <tbody>

                    @forelse($stockTransactions as $transaction)

                        <tr>

                            <td>{{ $loop->iteration + ($stockTransactions->firstItem() - 1) }}</td>

                            <td>{{ $transaction->stock_code }}</td>

                            <td>{{ \Carbon\Carbon::parse($transaction->stock_date)->format('d M Y') }}</td>

                            <td>{{ $transaction->product->name }}</td>

                            <td>
                                Rp {{ number_format($transaction->product->price,0,',','.') }}
                            </td>

                            <td>
                                <span class="badge badge-success">
                                    +{{ $transaction->qty }}
                                </span>
                            </td>

                            <td>
                                Rp {{ number_format($transaction->product->price * $transaction->qty,0,',','.') }}
                            </td>

                            <td>
                                <span class="badge badge-info">
                                    {{ $transaction->ending_stock }}
                                </span>
                            </td>

                            @if(auth()->user()->role == 'admin')

                                <td>

                                    {{ $transaction->merchant->name }}

                                </td>

                            @endif

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center">

                                Belum ada data barang masuk.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $stockTransactions->links() }}

        </div>

    </div>

</div>

@endsection