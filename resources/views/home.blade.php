@extends('layouts.app')

@section('title', 'ThriftMarket - Platform Jual Beli Barang Bekas')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Temukan Barang Bekas Berkualitas</h1>
                <p class="lead mb-4">Platform terpercaya untuk jual beli barang bekas dengan harga terjangkau dan kualitas terjamin.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('products') }}" class="btn btn-light btn-lg">Jelajahi Produk</a>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Daftar Sekarang</a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="Thrift Market" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Kategori Produk</h2>
        <div class="row g-4">
            @foreach($categories as $key => $category)
            <div class="col-md-4 col-lg-2">
                <a href="{{ route('products', ['category' => $key]) }}" class="text-decoration-none">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-{{ $key === 'fashion' ? 'tshirt' : ($key === 'electronics' ? 'laptop' : ($key === 'books' ? 'book' : ($key === 'home' ? 'home' : ($key === 'sports' ? 'futbol' : 'box')))) }} fa-3x text-primary mb-3"></i>
                            <h6 class="card-title">{{ $category }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Produk Unggulan</h2>
        <div class="row g-4">
            @forelse($featuredProducts as $product)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                    @else
                        <div class="card-img-top product-image bg-secondary d-flex align-items-center justify-content-center">
                            <i class="fas fa-image fa-3x text-white-50"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 60) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">{{ ucfirst($product->category) }}</span>
                            <span class="badge bg-secondary">{{ ucfirst($product->condition) }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada produk tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('products') }}" class="btn btn-primary">Lihat Semua Produk</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Mengapa Memilih ThriftMarket?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h5>Aman & Terpercaya</h5>
                    <p class="text-muted">Transaksi aman dengan sistem verifikasi penjual dan pembeli yang terpercaya.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-tags fa-3x text-primary mb-3"></i>
                    <h5>Harga Terjangkau</h5>
                    <p class="text-muted">Dapatkan barang berkualitas dengan harga yang lebih terjangkau dari harga baru.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-leaf fa-3x text-primary mb-3"></i>
                    <h5>Ramah Lingkungan</h5>
                    <p class="text-muted">Mendukung gerakan ramah lingkungan dengan mengurangi limbah dan konsumsi berlebihan.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 