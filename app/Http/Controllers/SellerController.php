<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalProducts = $user->products()->count();
        $totalSales = $user->products()->whereHas('orders', function($query) {
            $query->where('status', 'delivered');
        })->count();
        $totalRevenue = $user->products()->whereHas('orders', function($query) {
            $query->where('status', 'delivered');
        })->join('orders', 'products.id', '=', 'orders.product_id')
          ->sum('orders.total_price');

        $recentOrders = Order::whereHas('product', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['buyer', 'product'])->latest()->take(5)->get();

        return view('seller.dashboard', compact(
            'totalProducts',
            'totalSales',
            'totalRevenue',
            'recentOrders'
        ));
    }

    public function products()
    {
        $products = Auth::user()->products()->latest()->paginate(10);
        return view('seller.products', compact('products'));
    }

    public function createProduct()
    {
        return view('seller.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:fashion,electronics,books,home,sports,others',
            'condition' => 'required|in:new,like_new,good,fair,poor',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        Product::create($data);

        return redirect()->route('seller.products')->with('success', 'Product created successfully');
    }

    public function editProduct(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        return view('seller.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:fashion,electronics,books,home,sports,others',
            'condition' => 'required|in:new,like_new,good,fair,poor',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('seller.products')->with('success', 'Product updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('seller.products')->with('success', 'Product deleted successfully');
    }

    public function orders()
    {
        $orders = Order::whereHas('product', function($query) {
            $query->where('user_id', Auth::id());
        })->with(['buyer', 'product'])->latest()->paginate(10);

        return view('seller.orders', compact('orders'));
    }
}
