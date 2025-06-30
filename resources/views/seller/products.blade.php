@extends('layouts.app')

@section('title', 'My Products - ThriftMarket')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-3">
            <h5 class="mb-3">Seller Panel</h5>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('seller.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a class="nav-link active" href="{{ route('seller.products') }}">
                    <i class="fas fa-box me-2"></i>My Products
                </a>
                <a class="nav-link" href="{{ route('seller.products.create') }}">
                    <i class="fas fa-plus me-2"></i>Add Product
                </a>
                <a class="nav-link" href="{{ route('seller.orders') }}">
                    <i class="fas fa-shopping-cart me-2"></i>Orders
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>My Products</h2>
                <a href="{{ route('seller.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Product
                </a>
            </div>

            @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 class="card-img-top product-image" alt="{{ $product->name }}">
                        @else
                            <div class="card-img-top product-image bg-secondary d-flex align-items-center justify-content-center">
                                <i class="fas fa-image fa-3x text-white-50"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h6 class="card-title">{{ $product->name }}</h6>
                            <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary">{{ ucfirst($product->category) }}</span>
                                <span class="badge bg-secondary">{{ ucfirst($product->condition) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="badge bg-{{ $product->is_sold ? 'danger' : 'success' }}">
                                    {{ $product->is_sold ? 'Sold' : 'Available' }}
                                </span>
                            </div>
                            <small class="text-muted">Listed {{ $product->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex gap-2">
                                <a href="{{ route('seller.products.edit', $product) }}" 
                                   class="btn btn-sm btn-outline-primary flex-fill">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('seller.products.destroy', $product) }}" 
                                      method="POST" class="flex-fill" 
                                      onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-box fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No products yet</h4>
                <p class="text-muted">Start selling by adding your first product.</p>
                <a href="{{ route('seller.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Your First Product
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 