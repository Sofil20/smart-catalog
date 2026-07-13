<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockTransactionRequest;
use App\Models\Product;
use App\Models\StockTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    /**
     * Menampilkan daftar barang masuk.
     */
    public function index()
    {
        $stockTransactions = auth()->user()->role === 'admin'
            ? StockTransaction::with(['product', 'merchant'])
                ->latest('stock_date')
                ->paginate(10)
            : StockTransaction::where('merchant_id', auth()->id())
                ->with(['product', 'merchant'])
                ->latest('stock_date')
                ->paginate(10);

        return view('stock-transactions.index', compact('stockTransactions'));
    }

    /**
     * Menampilkan form barang masuk.
     */
    public function create()
    {
        $products = auth()->user()->role === 'admin'
            ? Product::orderBy('name')
                ->get(['id', 'name', 'price', 'stock'])
            : Product::where('user_id', auth()->id())
                ->orderBy('name')
                ->get(['id', 'name', 'price', 'stock']);

        return view('stock-transactions.create', compact('products'));
    }

    /**
     * Menyimpan barang masuk.
     */
    public function store(StoreStockTransactionRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        $stockCode = $this->generateStockCode();

        DB::transaction(function () use ($request, $product, $stockCode) {

            // Tambah stok
            $product->increment('stock', $request->qty);

            $product->refresh();


            // Ambil stok terbaru dari database
            $latestStock = Product::find($product->id)->stock;

            StockTransaction::create([

                'stock_code'   => $stockCode,

                'stock_date'   => now()->toDateString(),

                'product_id'   => $product->id,

                'merchant_id'  => auth()->id(),

                'qty'          => $request->qty,

                'ending_stock' => $latestStock,

            ]);

        });

        return redirect()
            ->route('stock-transactions.index')
            ->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    /**
     * Generate kode barang masuk.
     */
    private function generateStockCode(): string
    {
        $lastStock = StockTransaction::latest('id')->first();

        $number = $lastStock
            ? (int) substr($lastStock->stock_code, -4) + 1
            : 1;

        return 'STK-' .
            Carbon::now()->format('Ymd') .
            '-' .
            str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}