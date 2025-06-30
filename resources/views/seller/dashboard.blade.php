@extends('layouts.app')

@section('title', 'Seller Dashboard - ThriftMarket')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-3">
            <h5 class="mb-3">Seller Panel</h5>
            <nav class="nav flex-column">
                <a class="nav-link active" href="{{ route('seller.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a class="nav-link" href="{{ route('seller.products') }}">
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
            <h2 class="mb-4">Seller Dashboard</h2>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Products</h6>
                                    <h3 class="mb-0">{{ $totalProducts }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-box fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Sales</h6>
                                    <h3 class="mb-0">{{ $totalSales }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Revenue</h6>
                                    <h3 class="mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
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
                    <a href="{{ route('seller.orders') }}" class="btn btn-sm btn-primary">View All</a>
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
                                <small class="text-muted">Ordered by {{ $order->buyer->name }}</small>
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
                    <p class="text-muted text-center py-4">No orders yet. Start selling to see your orders here!</p>
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
                                <a href="{{ route('seller.products.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add New Product
                                </a>
                                <a href="{{ route('seller.products') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-box me-2"></i>Manage Products
                                </a>
                                <a href="{{ route('seller.orders') }}" class="btn btn-outline-success">
                                    <i class="fas fa-shopping-cart me-2"></i>View Orders
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Tips for Sellers</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Upload clear product photos
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Write detailed descriptions
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Set competitive prices
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Respond quickly to orders
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