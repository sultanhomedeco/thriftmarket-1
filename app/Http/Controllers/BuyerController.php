<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->where('status', 'delivered')->sum('total_price');
        $recentOrders = $user->orders()->with('product')->latest()->take(5)->get();

        return view('buyer.dashboard', compact(
            'totalOrders',
            'totalSpent',
            'recentOrders'
        ));
    }

    public function products(Request $request)
    {
        $query = Product::with('seller')->available();

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->byCategory($request->category);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->priceRange($request->min_price, $request->max_price ?? 999999);
        }

        // Search by name
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12);

        return view('buyer.products', compact('products'));
    }

    public function showProduct(Product $product)
    {
        return view('buyer.products.show', compact('product'));
    }

    public function checkout(Product $product)
    {
        if ($product->is_sold) {
            return back()->with('error', 'This product is already sold');
        }

        return view('buyer.checkout', compact('product'));
    }

    public function placeOrder(Request $request, Product $product)
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melakukan pemesanan.');
        }

        if ($product->is_sold) {
            return back()->with('error', 'This product is already sold');
        }

        $request->validate([
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:cash_on_delivery,bank_transfer',
        ]);

        $order = Order::create([
            'buyer_id' => Auth::id(),
            'product_id' => $product->id,
            'total_price' => $product->price,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        return redirect()->route('buyer.orders')->with('success', 'Order placed successfully');
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->with('product')->latest()->paginate(10);
        return view('buyer.orders', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        if ($order->buyer_id !== Auth::id()) {
            abort(403);
        }

        return view('buyer.orders.show', compact('order'));
    }
}
