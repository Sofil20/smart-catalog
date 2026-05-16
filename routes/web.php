<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    $userId = auth()->id();
    $categories = Category::where('user_id', $userId)
        ->withCount('products')
        ->get();

    $totalCategories = $categories->count();
    $totalProducts = Product::where('user_id', $userId)->count();
    $totalValue = Product::where('user_id', $userId)->sum('price');
    $averagePrice = $totalProducts ? Product::where('user_id', $userId)->avg('price') : 0;
    $recentProducts = Product::where('user_id', $userId)
        ->latest()
        ->limit(5)
        ->get();

    return view('dashboard', compact(
        'categories',
        'totalCategories',
        'totalProducts',
        'totalValue',
        'averagePrice',
        'recentProducts'
    ));
})->middleware(['authfilter'])->name('dashboard');

Route::middleware('authfilter')->group(function () {

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

});

Route::middleware(['authfilter', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        $totalMerchants = User::where('role', 'merchant')->count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $merchantStats = User::where('role', 'merchant')
            ->withCount('products')
            ->get();
        $recentMerchants = User::where('role', 'merchant')
            ->withCount('products')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMerchants',
            'totalCategories',
            'totalProducts',
            'merchantStats',
            'recentMerchants'
        ));
    })->name('admin.dashboard');

    Route::get('/admin/merchants', function () {
        $merchants = User::where('role', 'merchant')
            ->withCount('products')
            ->get();

        return view('admin.merchants', compact('merchants'));
    })->name('admin.merchants');

    Route::delete('/admin/merchants/{merchant}', function (User $merchant) {
        if ($merchant->role !== 'merchant') {
            abort(403);
        }

        if ($merchant->id === auth()->id()) {
            return redirect()->route('admin.merchants')->with('error', 'Anda tidak dapat menghapus akun admin sendiri.');
        }

        $merchant->delete();

        return redirect()->route('admin.merchants')->with('success', 'Merchant berhasil dihapus.');
    })->name('admin.merchants.destroy');

});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';