<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total_price');
        
        $recentOrders = Order::with(['buyer', 'product'])->latest()->take(5)->get();
        $recentProducts = Product::with('seller')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts', 
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'recentProducts'
        ));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function products()
    {
        $products = Product::with('seller')->latest()->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function orders()
    {
        $orders = Order::with(['buyer', 'product'])->latest()->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        if ($request->status === 'delivered') {
            $order->product->update(['is_sold' => true]);
        }

        return back()->with('success', 'Order status updated successfully');
    }
}
