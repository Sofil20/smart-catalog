<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesTransactionController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['authfilter'])
    ->name('dashboard');

Route::middleware('authfilter')->group(function () {
    Route::get('categories/export/excel', [CategoryController::class, 'export'])->name('categories.export');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sales-transactions', SalesTransactionController::class)
    ->only([
        'index',
        'create',
        'store',
        'show',
    ]);
    Route::resource('stock-transactions', StockTransactionController::class)
    ->only([
        'index',
        'create',
        'store',
        'show',
    ]);
    Route::get(
        '/reports/sales',
        [ReportController::class, 'sales']
    )->name('reports.sales');

    Route::get(
        '/reports/sales/excel',
        [ReportController::class, 'exportExcel']
    )->name('reports.sales.excel');

    Route::get(
        '/reports/sales/pdf',
        [ReportController::class, 'exportPdf']
    )->name('reports.sales.pdf');
});

    Route::middleware(['authfilter', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    Route::get('/admin/merchants', [AdminController::class, 'merchants'])
        ->name('admin.merchants');
    Route::delete('/admin/merchants/{merchant}', [AdminController::class, 'destroyMerchant'])
        ->name('admin.merchants.destroy');
});

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';