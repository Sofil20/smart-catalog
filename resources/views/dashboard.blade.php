@extends('layouts.adminlte')

@section('page-title', 'Dashboard')

@section('content')

<div class="mb-3">
    <h3>
        Selamat Datang,
        <strong>{{ Auth::user()->name }}</strong>
    </h3>
    <p class="text-muted">
        Dashboard Smart Catalog menampilkan ringkasan kondisi bisnis berdasarkan data transaksi.
    </p>
</div>

{{-- ================= KPI ================= --}}
<div class="row">

    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>{{ $totalProducts }}</h3>

                <p>Total Produk</p>

            </div>

            <div class="icon">

                <i class="fas fa-box"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>{{ $totalStockIn }}</h3>

                <p>Barang Masuk</p>

            </div>

            <div class="icon">

                <i class="fas fa-boxes"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>{{ $totalTransactions }}</h3>

                <p>Transaksi Penjualan</p>

            </div>

            <div class="icon">

                <i class="fas fa-shopping-cart"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>{{ $totalQtySold }}</h3>

                <p>Qty Terjual</p>

            </div>

            <div class="icon">

                <i class="fas fa-chart-line"></i>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-12">

        <div class="small-box bg-primary">

            <div class="inner">

                <h3>

                    Rp {{ number_format($totalRevenue,0,',','.') }}

                </h3>

                <p>Total Omzet</p>

            </div>

            <div class="icon">

                <i class="fas fa-money-bill-wave"></i>

            </div>

        </div>

    </div>

</div>

{{-- ================= SYSTEM INSIGHT ================= --}}

<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">
            <i class="fas fa-chart-line"></i>
            System Insight
        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <div class="card border-danger">

                    <div class="card-header bg-danger text-white">

                        <strong>Inventory Status</strong>

                    </div>

                    <div class="card-body">

                        <p>
                            <strong>Produk Stok Kritis :</strong>
                            {{ $totalCriticalProducts }} Produk
                        </p>

                        <p>
                            <strong>Total Stok :</strong>
                            {{ $totalStock }} pcs
                        </p>

                        <hr>

                        <h6>Produk yang Perlu Perhatian</h6>

                        <ul class="list-group">

                            @forelse($lowStockProducts as $product)

                                <li class="list-group-item d-flex justify-content-between">

                                    {{ $product->name }}

                                    <span class="badge badge-danger">

                                        {{ $product->stock }} pcs

                                    </span>

                                </li>

                            @empty

                                <li class="list-group-item">

                                    Semua stok dalam kondisi aman

                                </li>

                            @endforelse

                        </ul>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="card border-success">

                    <div class="card-header bg-success text-white">

                        <strong>Sales Performance</strong>

                    </div>

                    <div class="card-body">

                        <p>

                            <strong>Total Qty Terjual :</strong>

                            {{ $totalQtySold }} pcs

                        </p>

                        <p>

                            <strong>Total Omzet :</strong>

                            Rp {{ number_format($totalRevenue,0,',','.') }}

                        </p>

                        <hr>

                        <h6>Top 3 Best Seller</h6>

                        <ul class="list-group">

                            @foreach($bestSellingProducts as $item)

                                <li class="list-group-item d-flex justify-content-between">

                                    {{ $item->product->name }}

                                    <span class="badge badge-success">

                                        {{ $item->total_sales }} pcs

                                    </span>

                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ================= RECOMMENDATION ================= --}}

<div class="card card-success mt-3">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-lightbulb"></i>

            Recommendation By System

        </h3>

    </div>

    <div class="card-body">

        <h5 class="text-warning">

            Inventory Management

        </h5>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Produk</th>

                    <th>Prioritas</th>

                    <th>Rekomendasi</th>

                </tr>

            </thead>

            <tbody>

            @foreach($lowStockProducts as $product)

                <tr>

                    <td>{{ $product->name }}</td>

                    <td>

                        @if($product->stock<=3)

                            🔴 High

                        @elseif($product->stock<=6)

                            🟠 Medium

                        @else

                            🟢 Low

                        @endif

                    </td>

                    <td>

                        @if($product->stock<=3)

                            Restock minimal 20 pcs

                        @elseif($product->stock<=6)

                            Jadwalkan restock

                        @else

                            Monitoring stok

                        @endif

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        <hr>

        <h5 class="text-success">

            Sales Optimization

        </h5>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Produk</th>

                    <th>Status</th>

                    <th>Rekomendasi</th>

                </tr>

            </thead>

            <tbody>

            @foreach($bestSellingProducts as $index=>$item)

                <tr>

                    <td>{{ $item->product->name }}</td>

                    <td>

                        @if($index==0)

                            Best Seller

                        @else

                            High Demand

                        @endif

                    </td>

                    <td>

                        @if($index==0)

                            Tingkatkan promosi dan pastikan stok tersedia

                        @else

                            Pertahankan ketersediaan stok

                        @endif

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

<div class="card mt-4">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-history"></i>

            10 Transaksi Penjualan Terakhir

        </h3>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover">

            <thead class="bg-light">

                <tr>

                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>

                </tr>

            </thead>

            <tbody>

                @forelse($recentSales as $transaction)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

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

</div>

@endsection