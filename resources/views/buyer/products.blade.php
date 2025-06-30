@extends('layouts.app')

@section('title', 'Products - ThriftMarket')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('buyer.products') }}">
                        <!-- Search -->
                        <div class="mb-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="{{ request('search') }}" placeholder="Search products...">
                        </div>

                        <!-- Category Filter -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="all" {{ request('category') == 'all' || !request('category') ? 'selected' : '' }}>All Categories</option>
                                <option value="fashion" {{ request('category') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="electronics" {{ request('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="books" {{ request('category') == 'books' ? 'selected' : '' }}>Books</option>
                                <option value="home" {{ request('category') == 'home' ? 'selected' : '' }}>Home & Garden</option>
                                <option value="sports" {{ request('category') == 'sports' ? 'selected' : '' }}>Sports</option>
                                <option value="others" {{ request('category') == 'others' ? 'selected' : '' }}>Others</option>
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-3">
                            <label class="form-label">Price Range</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" class="form-control" name="min_price" 
                                           value="{{ request('min_price') }}" placeholder="Min">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" name="max_price" 
                                           value="{{ request('max_price') }}" placeholder="Max">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="{{ route('buyer.products') }}" class="btn btn-outline-secondary w-100 mt-2">Clear Filters</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Products</h2>
                <div class="text-muted">
                    {{ $products->total() }} products found
                </div>
            </div>

            @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-md-6 col-lg-4">
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
                            <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary">{{ ucfirst($product->category) }}</span>
                                <span class="badge bg-secondary">{{ ucfirst($product->condition) }}</span>
                            </div>
                            <small class="text-muted">Seller: {{ $product->seller->name }}</small>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('buyer.products.show', $product) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No products found</h4>
                <p class="text-muted">Try adjusting your search criteria or browse all products.</p>
                <a href="{{ route('buyer.products') }}" class="btn btn-primary">Browse All Products</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 