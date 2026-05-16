@extends('layouts.adminlte')

@section('page-title', 'Dashboard Analytics')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalCategories }}</h3>
                    <p>Total Kategori</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalProducts }}</h3>
                    <p>Total Produk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Rp {{ number_format($totalValue, 0, ',', '.') }}</h3>
                    <p>Total Nilai Produk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Rp {{ number_format($averagePrice, 0, ',', '.') }}</h3>
                    <p>Rata-rata Harga</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Analisis Produk per Kategori</h3>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" style="min-height: 280px; height: 280px; max-height: 280px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ringkasan Merchant</h3>
                </div>
                <div class="card-body">
                    <div class="info-box mb-3 bg-light">
                        <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Nama Merchant</span>
                            <span class="info-box-number">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                    <div class="info-box mb-3 bg-light">
                        <span class="info-box-icon bg-success"><i class="fas fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Email</span>
                            <span class="info-box-number">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-warning"><i class="fas fa-calendar-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tanggal</span>
                            <span class="info-box-number">{{ date('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Produk Terbaru</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProducts as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category?->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const categoryLabels = @json($categories->pluck('name'));
        const categoryData = @json($categories->pluck('products_count'));

        const ctx = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categoryLabels,
                datasets: [{
                    label: 'Produk per Kategori',
                    data: categoryData,
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>
@endpush