@extends('layouts.app')

@section('title', 'Buyer Dashboard - ThriftMarket')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-3">
            <h5 class="mb-3">Buyer Panel</h5>
            <nav class="nav flex-column">
                <a class="nav-link active" href="{{ route('buyer.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a class="nav-link" href="{{ route('buyer.products') }}">
                    <i class="fas fa-search me-2"></i>Browse Products
                </a>
                <a class="nav-link" href="{{ route('buyer.orders') }}">
                    <i class="fas fa-shopping-bag me-2"></i>My Orders
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <h2 class="mb-4">Buyer Dashboard</h2>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Orders</h6>
                                    <h3 class="mb-0">{{ $totalOrders }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-shopping-bag fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Spent</h6>
                                    <h3 class="mb-0">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-money-bill-wave fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Orders</h5>
                    <a href="{{ route('buyer.orders') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @forelse($recentOrders as $order)
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded">
                        <div class="d-flex align-items-center">
                            @if($order->product->image)
                                <img src="{{ asset('storage/' . $order->product->image) }}" 
                                     alt="{{ $order->product->name }}" 
                                     class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="me-3 bg-secondary d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-image text-white-50"></i>
                                </div>
                            @endif
                            <div>
                                <h6 class="mb-1">{{ $order->product->name }}</h6>
                                <small class="text-muted">Seller: {{ $order->product->seller->name }}</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                            <div class="fw-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                            <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center py-4">No orders yet. Start shopping to see your orders here!</p>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('buyer.products') }}" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Browse Products
                                </a>
                                <a href="{{ route('buyer.orders') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-shopping-bag me-2"></i>View My Orders
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Shopping Tips</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Check product condition carefully
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Read seller reviews
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Compare prices with similar items
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Ask questions before buying
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Categories -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Shop by Category</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-2 col-4">
                            <a href="{{ route('buyer.products', ['category' => 'fashion']) }}" class="text-decoration-none">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-tshirt fa-2x text-primary mb-2"></i>
                                        <h6 class="card-title">Fashion</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4">
                            <a href="{{ route('buyer.products', ['category' => 'electronics']) }}" class="text-decoration-none">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-laptop fa-2x text-primary mb-2"></i>
                                        <h6 class="card-title">Electronics</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4">
                            <a href="{{ route('buyer.products', ['category' => 'books']) }}" class="text-decoration-none">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-book fa-2x text-primary mb-2"></i>
                                        <h6 class="card-title">Books</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4">
                            <a href="{{ route('buyer.products', ['category' => 'home']) }}" class="text-decoration-none">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-home fa-2x text-primary mb-2"></i>
                                        <h6 class="card-title">Home</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4">
                            <a href="{{ route('buyer.products', ['category' => 'sports']) }}" class="text-decoration-none">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-futbol fa-2x text-primary mb-2"></i>
                                        <h6 class="card-title">Sports</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-4">
                            <a href="{{ route('buyer.products', ['category' => 'others']) }}" class="text-decoration-none">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-box fa-2x text-primary mb-2"></i>
                                        <h6 class="card-title">Others</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 