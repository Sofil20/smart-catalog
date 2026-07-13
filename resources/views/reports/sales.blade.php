@extends('layouts.adminlte')

@section('page-title', 'Laporan Penjualan')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">
            <i class="fas fa-chart-line mr-2"></i>
            Laporan Penjualan
        </h3>

        <div>

            <a href="{{ route('reports.sales.excel', request()->only(['start_date','end_date'])) }}"
                class="btn btn-success btn-sm">

                <i class="fas fa-file-excel"></i>
                Export Excel

            </a>

            <a href="{{ route('reports.sales.pdf', request()->only(['start_date','end_date'])) }}"
                class="btn btn-danger btn-sm">

                <i class="fas fa-file-pdf"></i>
                Export PDF

            </a>

        </div>

    </div>

    <div class="card-body">

        {{-- ================= FILTER ================= --}}
        <form method="GET" action="{{ route('reports.sales') }}">

            <div class="row mb-4">

                <div class="col-md-3">

                    <label>Tanggal Awal</label>

                    <input
                        type="date"
                        name="start_date"
                        class="form-control"
                        value="{{ request('start_date') }}">

                </div>

                <div class="col-md-3">

                    <label>Tanggal Akhir</label>

                    <input
                        type="date"
                        name="end_date"
                        class="form-control"
                        value="{{ request('end_date') }}">

                </div>

                <div class="col-md-6 d-flex align-items-end">

                    <button class="btn btn-primary mr-2">

                        <i class="fas fa-search"></i>
                        Filter

                    </button>

                    <a href="{{ route('reports.sales') }}"
                        class="btn btn-secondary">

                        <i class="fas fa-sync"></i>
                        Reset

                    </a>

                </div>

            </div>

        </form>

        {{-- ================= PERIODE ================= --}}
        @if(request('start_date') || request('end_date'))

            <div class="alert alert-info">

                <i class="fas fa-calendar-alt"></i>

                <strong>Periode Laporan :</strong>

                {{ request('start_date')
                    ? \Carbon\Carbon::parse(request('start_date'))->format('d M Y')
                    : '-' }}

                s/d

                {{ request('end_date')
                    ? \Carbon\Carbon::parse(request('end_date'))->format('d M Y')
                    : '-' }}

            </div>

        @endif

        {{-- ================= RINGKASAN ================= --}}
        <div class="row">

            <div class="col-lg-4 col-md-4">

                <div class="small-box bg-info">

                    <div class="inner">

                        <h3>{{ $salesTransactions->count() }}</h3>

                        <p>Total Transaksi</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-shopping-cart"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-4 col-md-4">

                <div class="small-box bg-success">

                    <div class="inner">

                        <h3>{{ $salesTransactions->sum('qty') }}</h3>

                        <p>Total Qty Terjual</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-box-open"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-4 col-md-4">

                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3>

                            Rp {{ number_format(
                                $salesTransactions->sum(function($item){
                                    return $item->product->price * $item->qty;
                                }),
                            0,',','.') }}

                        </h3>

                        <p>Total Penjualan</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-money-bill-wave"></i>

                    </div>

                </div>

            </div>

        </div>

        {{-- ================= TABEL ================= --}}
        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead class="thead-dark">

                    <tr>

                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>

                        @if(auth()->user()->role == 'admin')
                            <th>Merchant</th>
                        @endif

                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($salesTransactions as $transaction)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $transaction->transaction_code }}</td>

                            <td>

                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}

                            </td>

                            @if(auth()->user()->role == 'admin')

                                <td>{{ $transaction->merchant->name }}</td>

                            @endif

                            <td>{{ $transaction->product->name }}</td>

                            <td>

                                Rp {{ number_format($transaction->product->price,0,',','.') }}

                            </td>

                            <td>

                                {{ $transaction->qty }}

                            </td>

                            <td>

                                Rp {{ number_format($transaction->product->price * $transaction->qty,0,',','.') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="{{ auth()->user()->role == 'admin' ? 8 : 7 }}"
                                class="text-center">

                                Belum ada data transaksi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

                <tfoot>

                    <tr>

                        <th colspan="{{ auth()->user()->role == 'admin' ? 7 : 6 }}"
                            class="text-right">

                            Grand Total

                        </th>

                        <th>

                            Rp {{ number_format(
                                $salesTransactions->sum(function($item){
                                    return $item->product->price * $item->qty;
                                }),
                            0,',','.') }}

                        </th>

                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

</div>

@endsection