<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('seller')
            ->available()
            ->latest()
            ->take(8)
            ->get();

        $categories = [
            'fashion' => 'Fashion',
            'electronics' => 'Electronics',
            'books' => 'Books',
            'home' => 'Home & Garden',
            'sports' => 'Sports',
            'others' => 'Others'
        ];

        return view('home', compact('featuredProducts', 'categories'));
    }
}
