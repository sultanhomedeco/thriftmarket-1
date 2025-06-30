<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin ThriftMarket',
            'email' => 'admin@thriftmarket.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
        ]);

        // Create sample seller
        $seller = User::create([
            'name' => 'John Seller',
            'email' => 'seller@thriftmarket.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'phone' => '081234567891',
            'address' => 'Jl. Seller No. 1, Bandung',
        ]);

        // Create sample buyer
        $buyer = User::create([
            'name' => 'Jane Buyer',
            'email' => 'buyer@thriftmarket.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'phone' => '081234567892',
            'address' => 'Jl. Buyer No. 1, Surabaya',
        ]);

        // Create sample products
        $products = [
            [
                'name' => 'Vintage Denim Jacket',
                'description' => 'Classic vintage denim jacket in excellent condition. Perfect for casual wear.',
                'price' => 150000,
                'category' => 'fashion',
                'condition' => 'good',
                'user_id' => $seller->id,
            ],
            [
                'name' => 'MacBook Pro 2019',
                'description' => 'MacBook Pro 13-inch 2019 model. Still in great condition with original charger.',
                'price' => 8500000,
                'category' => 'electronics',
                'condition' => 'like_new',
                'user_id' => $seller->id,
            ],
            [
                'name' => 'Harry Potter Complete Set',
                'description' => 'Complete set of Harry Potter books in Indonesian. All 7 books included.',
                'price' => 250000,
                'category' => 'books',
                'condition' => 'good',
                'user_id' => $seller->id,
            ],
            [
                'name' => 'Vintage Coffee Table',
                'description' => 'Beautiful vintage wooden coffee table. Perfect for living room.',
                'price' => 500000,
                'category' => 'home',
                'condition' => 'fair',
                'user_id' => $seller->id,
            ],
            [
                'name' => 'Nike Running Shoes',
                'description' => 'Nike Air Max running shoes. Size 42, barely used.',
                'price' => 300000,
                'category' => 'sports',
                'condition' => 'like_new',
                'user_id' => $seller->id,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        // Create sample order
        $product = Product::first();
        Order::create([
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
            'total_price' => $product->price,
            'status' => 'pending',
            'shipping_address' => $buyer->address,
            'payment_method' => 'cash_on_delivery',
        ]);
    }
}
