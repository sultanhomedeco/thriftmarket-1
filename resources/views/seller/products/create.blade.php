@extends('layouts.app')

@section('title', 'Add Product - ThriftMarket')

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
                <a class="nav-link" href="{{ route('seller.products') }}">
                    <i class="fas fa-box me-2"></i>My Products
                </a>
                <a class="nav-link active" href="{{ route('seller.products.create') }}">
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
                <h2>Add New Product</h2>
                <a href="{{ route('seller.products') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Products
                </a>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Product Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price (Rp)</label>
                                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                                   id="price" name="price" value="{{ old('price') }}" min="0" required>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-select @error('category') is-invalid @enderror" 
                                                    id="category" name="category" required>
                                                <option value="">Select category</option>
                                                <option value="fashion" {{ old('category') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                                                <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                                <option value="books" {{ old('category') == 'books' ? 'selected' : '' }}>Books</option>
                                                <option value="home" {{ old('category') == 'home' ? 'selected' : '' }}>Home & Garden</option>
                                                <option value="sports" {{ old('category') == 'sports' ? 'selected' : '' }}>Sports</option>
                                                <option value="others" {{ old('category') == 'others' ? 'selected' : '' }}>Others</option>
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="condition" class="form-label">Condition</label>
                                            <select class="form-select @error('condition') is-invalid @enderror" 
                                                    id="condition" name="condition" required>
                                                <option value="">Select condition</option>
                                                <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                                                <option value="like_new" {{ old('condition') == 'like_new' ? 'selected' : '' }}>Like New</option>
                                                <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>Good</option>
                                                <option value="fair" {{ old('condition') == 'fair' ? 'selected' : '' }}>Fair</option>
                                                <option value="poor" {{ old('condition') == 'poor' ? 'selected' : '' }}>Poor</option>
                                            </select>
                                            @error('condition')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Provide a detailed description of your product including any defects or special features.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Upload a clear image of your product (optional but recommended).</div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-plus me-2"></i>Add Product
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Tips for Better Sales</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-camera text-primary me-2"></i>
                                    <strong>Take clear photos</strong><br>
                                    <small class="text-muted">Good lighting and multiple angles help buyers decide.</small>
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-edit text-primary me-2"></i>
                                    <strong>Write detailed descriptions</strong><br>
                                    <small class="text-muted">Include size, brand, condition details, and any defects.</small>
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-tags text-primary me-2"></i>
                                    <strong>Set competitive prices</strong><br>
                                    <small class="text-muted">Research similar items to price appropriately.</small>
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong>Respond quickly</strong><br>
                                    <small class="text-muted">Fast responses increase your chances of making a sale.</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 