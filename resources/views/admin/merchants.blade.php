@extends('layouts.adminlte')

@section('page-title', 'Merchant Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Daftar Merchant</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Merchant</th>
                            <th>Email</th>
                            <th>Produk</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($merchants as $index => $merchant)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $merchant->name }}</td>
                                <td>{{ $merchant->email }}</td>
                                <td>{{ $merchant->products_count }}</td>
                                <td>{{ $merchant->created_at->format('d M Y') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.merchants.destroy', $merchant) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus merchant ini? Semua kategori dan produk terkait akan ikut terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada merchant.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection