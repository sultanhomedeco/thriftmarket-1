@extends('layouts.app')

@section('title', 'Orders Management - ThriftMarket')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-3">
            <h5 class="mb-3">Admin Panel</h5>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a class="nav-link" href="{{ route('admin.users') }}">
                    <i class="fas fa-users me-2"></i>Users
                </a>
                <a class="nav-link" href="{{ route('admin.products') }}">
                    <i class="fas fa-box me-2"></i>Products
                </a>
                <a class="nav-link active" href="{{ route('admin.orders') }}">
                    <i class="fas fa-shopping-cart me-2"></i>Orders
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <h2 class="mb-4">Orders Management</h2>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Buyer</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        @if($order->product && $order->product->image)
                                            <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" style="width:32px;height:32px;object-fit:cover;" class="me-2 rounded">
                                        @endif
                                        {{ $order->product->name ?? '-' }}
                                    </td>
                                    <td>{{ $order->buyer->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'secondary') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-shopping-cart fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">No orders found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
