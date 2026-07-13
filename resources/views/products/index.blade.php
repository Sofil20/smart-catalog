@extends('layouts.adminlte')

@section('page-title', 'Produk')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Daftar Produk</h3>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card card-outline card-info mb-4 h-100 d-flex flex-column">
                            <div class="card-body d-flex flex-column">
                                <div class="mb-3" style="overflow:hidden; max-height:220px;">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded w-100" style="object-fit: cover; height: 220px; width: 100%;">
                                </div>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted mb-4">{{ $product->description }}</p>
                                <div class="mb-3">
                                    <span class="badge badge-primary">{{ $product->category->name }}</span>
                                    @if(Auth::user()->role === 'admin')
                                        <span class="badge badge-secondary">{{ $product->user->name ?? 'Merchant tidak ditemukan' }}</span>
                                    @endif
                                </div>
                                <div class="mt-auto">
                                    <p class="text-success font-weight-bold mb-1">
                                        Rp {{ number_format($product->price,0,',','.') }}
                                    </p>
                                    @if($product->stock > 10)
                                        <span class="badge badge-success">
                                            Stock : {{ $product->stock }}
                                        </span>
                                    @elseif($product->stock > 0)
                                        <span class="badge badge-warning">
                                            Stock : {{ $product->stock }}
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            Stock Habis
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0">

                                <div class="d-flex justify-content-between">

                                    <a href="{{ route('products.edit', $product) }}"
                                    class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>
                                        Edit

                                    </a>

                                    @if($product->stock == 0)

                                        <form method="POST"
                                            action="{{ route('products.destroy', $product) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">

                                                <i class="fas fa-trash"></i>
                                                Hapus

                                            </button>

                                        </form>

                                    @else

                                        <button class="btn btn-secondary btn-sm" disabled>

                                            <i class="fas fa-trash"></i>
                                                Hapus

                                        </button>

                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-secondary text-center">Belum ada produk.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection