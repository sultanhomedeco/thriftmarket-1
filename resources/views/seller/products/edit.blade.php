@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>
    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-control" id="category" name="category" required>
                <option value="fashion" {{ $product->category == 'fashion' ? 'selected' : '' }}>Fashion</option>
                <option value="electronics" {{ $product->category == 'electronics' ? 'selected' : '' }}>Electronics</option>
                <option value="books" {{ $product->category == 'books' ? 'selected' : '' }}>Books</option>
                <option value="home" {{ $product->category == 'home' ? 'selected' : '' }}>Home</option>
                <option value="sports" {{ $product->category == 'sports' ? 'selected' : '' }}>Sports</option>
                <option value="others" {{ $product->category == 'others' ? 'selected' : '' }}>Others</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="condition" class="form-label">Kondisi</label>
            <select class="form-control" id="condition" name="condition" required>
                <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}>Baru</option>
                <option value="like_new" {{ $product->condition == 'like_new' ? 'selected' : '' }}>Seperti Baru</option>
                <option value="good" {{ $product->condition == 'good' ? 'selected' : '' }}>Bagus</option>
                <option value="fair" {{ $product->condition == 'fair' ? 'selected' : '' }}>Cukup</option>
                <option value="poor" {{ $product->condition == 'poor' ? 'selected' : '' }}>Kurang</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" width="120" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection 