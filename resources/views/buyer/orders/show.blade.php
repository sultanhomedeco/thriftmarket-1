@extends('layouts.app')

@section('title', 'Order Detail - ThriftMarket')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buyer.orders') }}">My Orders</a></li>
            <li class="breadcrumb-item active">Order #{{ $order->id }}</li>
        </ol>
    </nav>

    <h2 class="mb-4">Order #{{ $order->id }}</h2>

    <div class="row">
        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($order->product->image)
                            <img src="{{ asset('storage/' . $order->product->image) }}" 
                                 alt="{{ $order->product->name }}" 
                                 class="me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="me-3 bg-secondary d-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-image text-white-50"></i>
                            </div>
                        @endif
                        <div>
                            <h5 class="mb-1">{{ $order->product->name }}</h5>
                            <span class="badge bg-primary me-2">{{ ucfirst($order->product->category) }}</span>
                            <span class="badge bg-secondary">{{ ucfirst($order->product->condition) }}</span>
                        </div>
                    </div>
                    <p class="text-muted">{{ $order->product->description }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Order Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6"><strong>Status:</strong></div>
                        <div class="col-6">
                            <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'pending' ? 'warning' : ($order->status === 'cancelled' ? 'danger' : 'info')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Total Price:</strong></div>
                        <div class="col-6">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Payment Method:</strong></div>
                        <div class="col-6">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Order Date:</strong></div>
                        <div class="col-6">{{ $order->created_at->format('M d, Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Shipping Address</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Seller Information</h5>
                </div>
                <div class="card-body">
                    <strong>{{ $order->product->seller->name }}</strong><br>
                    <small class="text-muted">{{ $order->product->seller->email }}</small><br>
                    @if($order->product->seller->phone)
                        <small class="text-muted">{{ $order->product->seller->phone }}</small><br>
                    @endif
                    @if($order->product->seller->address)
                        <small class="text-muted">{{ $order->product->seller->address }}</small>
                    @endif
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Product Price:</span>
                        <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span class="text-muted">To be discussed</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('buyer.orders') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to My Orders
        </a>
    </div>
</div>
@endsection 