@extends('layouts.adminlte')

@section('page-title', 'Transaksi Penjualan')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">
            Daftar Transaksi Penjualan
        </h3>

        <a href="{{ route('sales-transactions.create') }}"
            class="btn btn-primary btn-sm">

            <i class="fas fa-plus"></i>

            Tambah Transaksi

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
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Qty</th>
                        <th>Total Penjualan</th>
                        <th>Saldo Akhir</th>

                        @if(auth()->user()->role == 'admin')
                            <th>Merchant</th>
                        @endif
                        
                    </tr>

                </thead>

                <tbody>

                    @forelse($salesTransactions as $transaction)

                        <tr>

                            <td>{{ $loop->iteration + ($salesTransactions->firstItem() - 1) }}</td>

                            <td>{{ $transaction->transaction_code }}</td>

                            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</td>

                            <td>{{ $transaction->product->name }}</td>

                            <td>
                                Rp {{ number_format($transaction->product->price,0,',','.') }}
                            </td>

                            <td>
                                <span class="badge badge-danger">
                                    -{{ $transaction->qty }}
                                </span>
                            </td>

                            <td>
                                Rp {{ number_format($transaction->product->price * $transaction->qty,0,',','.') }}
                            </td>

                            <td>
                                <span class="badge badge-primary">
                                    {{ $transaction->ending_stock }}
                                </span>
                            </td>

                            @if(auth()->user()->role == 'admin')
                                <td>{{ $transaction->merchant->name }}</td>
                            @endif

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                Belum ada transaksi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $salesTransactions->links() }}

        </div>

    </div>

</div>

@endsection