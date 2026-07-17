# Smart-Catalog

Smart-Catalog adalah aplikasi berbasis web yang dirancang untuk membantu UMKM dalam mengelola katalog produk dan transaksi penjualan secara digital. Aplikasi dibangun menggunakan Laravel 13 dengan arsitektur Model-View-Controller (MVC) dan mendukung manajemen stok, transaksi, laporan, serta dashboard analitik.

## Fitur

### Autentikasi
- Login & Register
- Role Admin dan Merchant
- Middleware Authentication

### Master Data
- CRUD Kategori
- CRUD Produk
- Upload Foto Produk

### Transaksi
- Barang Masuk
- Transaksi Penjualan
- Update stok otomatis
- Riwayat transaksi

### Dashboard
- Dashboard Admin
- Dashboard Merchant
- Ringkasan Produk
- Ringkasan Stok
- Total Penjualan
- Total Pendapatan
- Produk Terlaris
- Produk dengan Stok Menipis
- System Insight & Recommendation

### Laporan
- Laporan Penjualan
- Filter berdasarkan tanggal
- Export PDF
- Export Excel

## Teknologi

- Laravel 13
- PHP 8.3
- MySQL
- Bootstrap 4
- AdminLTE 3
- Maatwebsite Excel
- DomPDF

## Cara Menjalankan

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
```

## Database

Import file database berikut:

```text
smart_catalog.sql
```

Kemudian sesuaikan konfigurasi database pada file `.env`.

## Akun

Silakan melakukan registrasi akun baru atau menggunakan data yang tersedia pada database yang diimport.

## Author

Muhamad Sofil Mubarok
Universitas Dian Nusantara