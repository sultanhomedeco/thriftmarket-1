@extends('layouts.app')

@section('title', 'Checkout - ThriftMarket')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buyer.products') }}">Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buyer.products.show', $product) }}">{{ $product->name }}</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Checkout Form -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('buyer.products.order', $product) }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Shipping Address</label>
                            <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                      id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address', Auth::check() ? Auth::user()->address : '') }}</textarea>
                            @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                    id="payment_method" name="payment_method" required>
                                <option value="">Select payment method</option>
                                <option value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Note:</strong> You will be contacted by the seller to arrange payment and delivery details.
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-cart me-2"></i>Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div class="me-3 bg-secondary d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-image text-white-50"></i>
                            </div>
                        @endif
                        <div>
                            <h6 class="mb-1">{{ $product->name }}</h6>
                            <small class="text-muted">Seller: {{ $product->seller->name }}</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <span class="badge bg-primary me-2">{{ ucfirst($product->category) }}</span>
                        <span class="badge bg-secondary">{{ ucfirst($product->condition) }}</span>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted small">{{ Str::limit($product->description, 100) }}</p>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Product Price:</span>
                        <span>Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span class="text-muted">To be discussed</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <div class="alert alert-warning mt-3">
                        <small>
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Final price may vary based on shipping costs and location.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Seller Information -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Seller Information</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                             style="width: 40px; height: 40px;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $product->seller->name }}</h6>
                            <small class="text-muted">Seller</small>
                        </div>
                    </div>
                    @if($product->seller->phone)
                        <div class="mb-1">
                            <small class="text-muted">
                                <i class="fas fa-phone me-1"></i>
                                {{ $product->seller->phone }}
                            </small>
                        </div>
                    @endif
                    @if($product->seller->address)
                        <div>
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ Str::limit($product->seller->address, 50) }}
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 