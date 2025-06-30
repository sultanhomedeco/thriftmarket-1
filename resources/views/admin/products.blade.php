@extends('layouts.app')

@section('title', 'Products Management - ThriftMarket')

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
                <a class="nav-link active" href="{{ route('admin.products') }}">
                    <i class="fas fa-box me-2"></i>Products
                </a>
                <a class="nav-link" href="{{ route('admin.orders') }}">
                    <i class="fas fa-shopping-cart me-2"></i>Orders
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <h2 class="mb-4">Products Management</h2>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Seller</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->seller->name ?? '-' }}</td>
                                    <td>{{ ucfirst($product->category) }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $product->is_sold ? 'secondary' : 'success' }}">
                                            {{ $product->is_sold ? 'Sold' : 'Available' }}
                                        </span>
                                    </td>
                                    <td>{{ $product->created_at->format('M d, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-box fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">No products found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 