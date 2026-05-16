@extends('layouts.adminlte')

@section('page-title', 'Edit Produk')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Produk</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-control" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" class="form-control" required>
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Foto Produk (Biarkan kosong jika tidak ingin mengubah)</label>
                    <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                    <small class="form-text text-muted">Max 2 MB</small>
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="mt-2 img-fluid rounded" style="max-width: 150px;">
                    @endif
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection