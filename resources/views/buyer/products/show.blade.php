@extends('layouts.app')

@section('title', $product->name . ' - ThriftMarket')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buyer.products') }}">Products</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="img-fluid rounded shadow">
            @else
                <div class="bg-secondary d-flex align-items-center justify-content-center rounded shadow" 
                     style="height: 400px;">
                    <i class="fas fa-image fa-5x text-white-50"></i>
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->name }}</h2>
            
            <div class="mb-3">
                <span class="h3 text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>

            <div class="mb-3">
                <span class="badge bg-primary me-2">{{ ucfirst($product->category) }}</span>
                <span class="badge bg-secondary">{{ ucfirst($product->condition) }}</span>
            </div>

            <div class="mb-4">
                <h6>Description:</h6>
                <p class="text-muted">{{ $product->description }}</p>
            </div>

            <div class="mb-4">
                <h6>Seller Information:</h6>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">{{ $product->seller->name }}</h6>
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{ $product->seller->address ?: 'Address not provided' }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($product->is_sold)
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This product has been sold.
                </div>
            @else
                <div class="d-grid">
                    <a href="{{ route('buyer.products.checkout', $product) }}" 
                       class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i>Buy Now
                    </a>
                </div>
            @endif

            <div class="mt-4">
                <small class="text-muted">
                    <i class="fas fa-clock me-1"></i>
                    Listed {{ $product->created_at->diffForHumans() }}
                </small>
            </div>
        </div>
    </div>

    <!-- Similar Products -->
    <div class="mt-5">
        <h4 class="mb-4">Similar Products</h4>
        <div class="row g-4">
            @php
                $similarProducts = \App\Models\Product::where('category', $product->category)
                    ->where('id', '!=', $product->id)
                    ->where('is_sold', false)
                    ->with('seller')
                    ->take(3)
                    ->get();
            @endphp
            
            @forelse($similarProducts as $similarProduct)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($similarProduct->image)
                        <img src="{{ asset('storage/' . $similarProduct->image) }}" 
                             class="card-img-top product-image" alt="{{ $similarProduct->name }}">
                    @else
                        <div class="card-img-top product-image bg-secondary d-flex align-items-center justify-content-center">
                            <i class="fas fa-image fa-3x text-white-50"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $similarProduct->name }}</h6>
                        <p class="card-text text-muted small">{{ Str::limit($similarProduct->description, 60) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">Rp {{ number_format($similarProduct->price, 0, ',', '.') }}</span>
                            <a href="{{ route('buyer.products.show', $similarProduct) }}" 
                               class="btn btn-sm btn-outline-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No similar products found.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection 