@extends('layouts.adminlte')

@section('page-title', 'Edit Kategori')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Kategori</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('categories.update', $category) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-control" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection