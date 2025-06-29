# ThriftMarket - Platform Jual Beli Barang Bekas

ThriftMarket adalah platform e-commerce untuk jual beli barang bekas (preloved) berkualitas dengan sistem autentikasi multilevel. Platform ini menghubungkan penjual dan pembeli dalam satu sistem yang aman dan mudah digunakan.

## 🚀 Fitur Utama

### 🔐 Autentikasi Multilevel
- **Admin**: Akses penuh untuk mengelola semua user, produk, dan transaksi
- **Penjual**: Dapat menambahkan, mengedit, dan mengelola produk mereka
- **Pembeli**: Dapat melihat produk, melakukan pembelian, dan melacak pesanan

### 🛍️ Manajemen Produk
- CRUD produk dengan gambar dan deskripsi detail
- Kategori produk (Fashion, Electronics, Books, Home, Sports, Others)
- Kondisi produk (New, Like New, Good, Fair, Poor)
- Status ketersediaan (Available/Sold)

### 💳 Sistem Transaksi
- Proses checkout yang sederhana
- Metode pembayaran (Cash on Delivery, Bank Transfer)
- Status pesanan (Pending, Confirmed, Shipped, Delivered, Cancelled)
- Riwayat transaksi untuk pembeli dan penjual

### 🔍 Fitur Pencarian dan Filter
- Pencarian berdasarkan nama produk
- Filter berdasarkan kategori
- Filter berdasarkan rentang harga
- Pagination untuk performa yang baik

### 📊 Dashboard Berbasis Role
- **Admin Dashboard**: Statistik total user, produk, pesanan, dan revenue
- **Seller Dashboard**: Statistik produk, penjualan, dan revenue
- **Buyer Dashboard**: Riwayat pembelian dan total pengeluaran

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12.x
- **Frontend**: Blade Templates + Bootstrap 5
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Built-in Auth
- **File Storage**: Laravel Storage
- **Icons**: Font Awesome 6

## 📋 Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- MySQL/SQLite
- Web Server (Apache/Nginx) atau PHP Built-in Server

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd thriftmarket
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=thriftmarket
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migration dan Seeder
```bash
php artisan migrate
php artisan db:seed --class=AdminUserSeeder
```

### 6. Setup Storage Link
```bash
php artisan storage:link
```

### 7. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 👥 Akun Default

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

### Admin
- Email: `admin@thriftmarket.com`
- Password: `password`

### Seller
- Email: `seller@thriftmarket.com`
- Password: `password`

### Buyer
- Email: `buyer@thriftmarket.com`
- Password: `password`

## 📁 Struktur Proyek

```
thriftmarket/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── AuthController.php
│   │   │   ├── BuyerController.php
│   │   │   ├── HomeController.php
│   │   │   └── SellerController.php
│   │   └── Middleware/
│   │       └── CheckRole.php
│   └── Models/
│       ├── Order.php
│       ├── Product.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── AdminUserSeeder.php
├── resources/
│   └── views/
│       ├── admin/
│       ├── auth/
│       ├── buyer/
│       ├── seller/
│       └── layouts/
└── routes/
    └── web.php
```

## 🔐 Middleware dan Authorization

### CheckRole Middleware
Middleware ini mengontrol akses berdasarkan role user:
```php
// Contoh penggunaan di routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Routes untuk admin
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    // Routes untuk seller
});

Route::middleware(['auth', 'role:buyer'])->group(function () {
    // Routes untuk buyer
});
```

## 🎨 Customization

### Menambah Kategori Produk
Edit migration `create_products_table.php` dan tambahkan kategori baru di enum:
```php
$table->enum('category', ['fashion', 'electronics', 'books', 'home', 'sports', 'others', 'new_category']);
```

### Menambah Role Baru
1. Edit migration `add_role_to_users_table.php`
2. Tambahkan role baru di enum
3. Update model User dengan method helper baru

## 🐛 Troubleshooting

### Error "Class not found"
```bash
composer dump-autoload
```

### Error "Table not found"
```bash
php artisan migrate:fresh
php artisan db:seed --class=AdminUserSeeder
```

### Error "Storage link not found"
```bash
php artisan storage:link
```

## 📝 License

Proyek ini dibuat untuk tujuan edukasi dan pembelajaran. Silakan gunakan dan modifikasi sesuai kebutuhan.

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan buat pull request atau laporkan issue jika menemukan bug atau ingin menambah fitur baru.

## 📞 Support

Jika ada pertanyaan atau masalah, silakan buat issue di repository ini.

---

**ThriftMarket** - Platform jual beli barang bekas yang aman dan terpercaya! 🛍️
