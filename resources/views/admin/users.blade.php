@extends('layouts.app')

@section('title', 'Users Management - ThriftMarket')

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
                <a class="nav-link active" href="{{ route('admin.users') }}">
                    <i class="fas fa-users me-2"></i>Users
                </a>
                <a class="nav-link" href="{{ route('admin.products') }}">
                    <i class="fas fa-box me-2"></i>Products
                </a>
                <a class="nav-link" href="{{ route('admin.orders') }}">
                    <i class="fas fa-shopping-cart me-2"></i>Orders
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <h2 class="mb-4">Users Management</h2>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                 style="width: 35px; height: 35px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'seller' ? 'success' : 'primary') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->phone ?: '-' }}</td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                                    data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- User Detail Modal -->
                                <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">User Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Name:</strong><br>
                                                        {{ $user->name }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Email:</strong><br>
                                                        {{ $user->email }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Role:</strong><br>
                                                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'seller' ? 'success' : 'primary') }}">
                                                            {{ ucfirst($user->role) }}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Phone:</strong><br>
                                                        {{ $user->phone ?: 'Not provided' }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <strong>Address:</strong><br>
                                                        {{ $user->address ?: 'Not provided' }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Joined:</strong><br>
                                                        {{ $user->created_at->format('M d, Y H:i') }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Last Updated:</strong><br>
                                                        {{ $user->updated_at->format('M d, Y H:i') }}
                                                    </div>
                                                </div>
                                                @if($user->role === 'seller')
                                                <hr>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <strong>Seller Statistics:</strong><br>
                                                        <small class="text-muted">
                                                            Products: {{ $user->products->count() }} | 
                                                            Orders: {{ $user->products->filter(fn($p) => $p->orders->count() > 0)->count() }}
                                                        </small>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($user->role === 'buyer')
                                                <hr>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <strong>Buyer Statistics:</strong><br>
                                                        <small class="text-muted">
                                                            Orders: {{ $user->orders->count() }} | 
                                                            Total Spent: Rp {{ number_format($user->orders->where('status', 'delivered')->sum('total_price'), 0, ',', '.') }}
                                                        </small>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">No users found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Users</h6>
                                    <h3 class="mb-0">{{ $users->total() }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Sellers</h6>
                                    <h3 class="mb-0">{{ $users->where('role', 'seller')->count() }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-store fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Buyers</h6>
                                    <h3 class="mb-0">{{ $users->where('role', 'buyer')->count() }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-shopping-cart fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Admins</h6>
                                    <h3 class="mb-0">{{ $users->where('role', 'admin')->count() }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-user-shield fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 