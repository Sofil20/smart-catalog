@extends('layouts.adminlte')

@section('page-title', 'Tambah Barang Masuk')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Form Barang Masuk
        </h3>
    </div>

    <div class="card-body">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('stock-transactions.store') }}">

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

                    Jumlah Barang Masuk

                </label>

                <input
                    type="number"
                    name="qty"
                    id="qty"
                    class="form-control"
                    value="{{ old('qty') }}"
                    min="1"
                    max="9999999999"
                    placeholder="Masukkan jumlah barang"
                    required>

                @error('qty')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <button
                type="submit"
                class="btn btn-success">

                <i class="fas fa-plus-circle"></i>

                Tambah Stock

            </button>

            <a
                href="{{ route('stock-transactions.index') }}"
                class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection