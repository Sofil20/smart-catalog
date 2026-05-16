# Smart-Catalog

Smart-Catalog adalah aplikasi berbasis web untuk membantu UMKM dalam mengelola katalog produk secara digital menggunakan framework Laravel 13 dan database MySQL.

Aplikasi ini menerapkan konsep MVC (Model View Controller) serta memiliki fitur autentikasi, manajemen kategori produk, upload gambar produk, middleware keamanan, dan dashboard dinamis.

## Fitur

* Login & Register
* Dashboard Dinamis
* CRUD Kategori
* CRUD Produk
* Upload Foto Produk
* Middleware Authentication
* Role Admin & Merchant

## Teknologi

* Laravel 13
* PHP
* MySQL
* Bootstrap / AdminLTE

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

Import file:

```text
smart_catalog.sql
```

## Author

Muhamad Sofil Mubarok
