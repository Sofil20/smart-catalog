<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
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
    }
}
