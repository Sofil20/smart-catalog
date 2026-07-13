@extends('layouts.adminlte')

@section('page-title', 'Tambah Transaksi Penjualan')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Form Transaksi Penjualan
        </h3>
    </div>

    <div class="card-body">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('sales-transactions.store') }}">

            @csrf

            <div class="form-group">

                <label for="product_id">
                    Produk
                </label>

                <select
                    name="product_id"
                    id="product_id"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Produk --
                    </option>

                    @foreach($products as $product)

                        <option
                            value="{{ $product->id }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>

                            {{ $product->name }}
                            -
                            Rp {{ number_format($product->price,0,',','.') }}
                            (Stock : {{ $product->stock }})

                        </option>

                    @endforeach

                </select>

                @error('product_id')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div class="form-group">

                <label for="qty">

                    Jumlah Terjual

                </label>

                <input
                    type="number"
                    name="qty"
                    id="qty"
                    class="form-control"
                    value="{{ old('qty') }}"
                    min="1"
                    placeholder="Masukkan jumlah produk"
                    required>

                @error('qty')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan Transaksi

            </button>

            <a
                href="{{ route('sales-transactions.index') }}"
                class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection