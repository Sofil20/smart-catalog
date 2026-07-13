<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SalesTransaction;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $userId = auth()->id();

        /*
        |--------------------------------------------------------------------------
        | KPI
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::where('user_id', $userId)->count();

        // Total Qty Barang Masuk
        $totalStockIn = StockTransaction::where('merchant_id', $userId)
            ->sum('qty');

        // Jumlah transaksi penjualan
        $totalTransactions = SalesTransaction::where('merchant_id', $userId)
            ->count();

        // Total Qty Terjual
        $totalQtySold = SalesTransaction::where('merchant_id', $userId)
            ->sum('qty');

        // Total Omzet
        $totalRevenue = SalesTransaction::where('merchant_id', $userId)
            ->join('products', 'sales_transactions.product_id', '=', 'products.id')
            ->select(DB::raw('SUM(products.price * sales_transactions.qty) as total'))
            ->value('total') ?? 0;

        /*
        |--------------------------------------------------------------------------
        | SYSTEM INSIGHT
        |--------------------------------------------------------------------------
        */

        // Total produk dengan stok kritis
        $totalCriticalProducts = Product::where('user_id', $userId)
            ->where('stock', '<', 10)
            ->count();

        // Total seluruh stok produk
        $totalStock = Product::where('user_id', $userId)
            ->sum('stock');

        // Produk terlaris
        $bestSeller = SalesTransaction::select(
                'product_id',
                DB::raw('SUM(qty) as total_sales')
            )
            ->where('merchant_id', $userId)
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total_sales')
            ->first();

        $lowStockProducts = Product::where('user_id', $userId)
        ->where('stock', '<', 10)
        ->orderBy('stock', 'asc')
        ->take(3)
        ->get();

        $bestSellingProducts = SalesTransaction::select(
            'product_id',
            DB::raw('SUM(qty) as total_sales')
        )
        ->where('merchant_id', $userId)
        ->groupBy('product_id')
        ->with('product')
        ->orderByDesc('total_sales')
        ->take(3)
        ->get();

        $recentSales = SalesTransaction::where('merchant_id', $userId)
        ->with('product')
        ->orderByDesc('id')
        ->take(10)
        ->get();

        return view('dashboard', compact(

        'totalProducts',

        'totalStockIn',

        'totalTransactions',

        'totalQtySold',

        'totalRevenue',

        'totalCriticalProducts',

        'totalStock',

        'bestSeller',

        'lowStockProducts',

        'bestSellingProducts',

        'recentSales'

    ));
    }
}
