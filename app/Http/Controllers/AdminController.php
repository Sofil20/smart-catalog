<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
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
    }

    public function merchants(): View
    {
        $merchants = User::where('role', 'merchant')
            ->withCount('products')
            ->get();

        return view('admin.merchants', compact('merchants'));
    }

    public function destroyMerchant(User $merchant): RedirectResponse
    {
        if ($merchant->role !== 'merchant') {
            abort(403);
        }

        if ($merchant->id === auth()->id()) {
            return redirect()->route('admin.merchants')
                ->with('error', 'Anda tidak dapat menghapus akun admin sendiri.');
        }

        $merchant->delete();

        return redirect()->route('admin.merchants')
            ->with('success', 'Merchant berhasil dihapus.');
    }
}
