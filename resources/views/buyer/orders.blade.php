@extends('layouts.app')

@section('title', 'My Orders - ThriftMarket')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">My Orders</li>
        </ol>
    </nav>

    <h2 class="mb-4">My Orders</h2>

    <div class="card">
        <div class="card-body">
            @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Seller</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($order->product->image)
                                        <img src="{{ asset('storage/' . $order->product->image) }}" 
                                             alt="{{ $order->product->name }}" 
                                             class="me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="me-2 bg-secondary d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-image text-white-50"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $order->product->name }}</strong><br>
                                        <small class="text-muted">{{ ucfirst($order->product->category) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $order->product->seller->name }}</td>
                            <td><strong class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                            <td>
                                <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'pending' ? 'warning' : ($order->status === 'cancelled' ? 'danger' : 'info')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                <a href="{{ route('buyer.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">You have no orders yet</h4>
                <p class="text-muted">Start shopping to see your orders here!</p>
                <a href="{{ route('buyer.products') }}" class="btn btn-primary">Browse Products</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 