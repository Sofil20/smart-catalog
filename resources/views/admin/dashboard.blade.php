@extends('layouts.adminlte')

@section('page-title', 'Admin Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalMerchants }}</h3>
                    <p>Merchant Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalCategories }}</h3>
                    <p>Total Kategori</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
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
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $merchantStats->max('products_count') ?? 0 }}</h3>
                    <p>Produk Maks per Merchant</p>
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
                    <h3 class="card-title">Produk per Merchant</h3>
                </div>
                <div class="card-body">
                    <canvas id="merchantChart" style="min-height: 280px; height: 280px; max-height: 280px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Merchant Terbaru</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($recentMerchants as $merchant)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $merchant->name }}
                                <span class="badge badge-primary badge-pill">{{ $merchant->products_count ?? 0 }}</span>
                            </li>
                        @empty
                            <li class="list-group-item">Belum ada merchant.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Merchant</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Merchant</th>
                                <th>Email</th>
                                <th>Produk</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($merchantStats as $index => $merchant)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $merchant->name }}</td>
                                    <td>{{ $merchant->email }}</td>
                                    <td>{{ $merchant->products_count }}</td>
                                    <td>{{ $merchant->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
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
        const merchantLabels = @json($merchantStats->pluck('name'));
        const merchantData = @json($merchantStats->pluck('products_count'));

        const ctx = document.getElementById('merchantChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: merchantLabels,
                datasets: [{
                    label: 'Produk per Merchant',
                    data: merchantData,
                    backgroundColor: 'rgba(255, 193, 7, 0.8)',
                    borderColor: 'rgba(255, 193, 7, 1)',
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