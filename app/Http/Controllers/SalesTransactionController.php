<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalesTransactionRequest;
use App\Models\Product;
use App\Models\SalesTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesTransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi.
     */
    public function index()
    {
        $salesTransactions = auth()->user()->role === 'admin'
            ? SalesTransaction::with(['product', 'merchant'])
                ->latest('transaction_date')
                ->paginate(10)
            : SalesTransaction::where('merchant_id', auth()->id())
                ->with(['product', 'merchant'])
                ->latest('transaction_date')
                ->paginate(10);

        return view('sales-transactions.index', compact('salesTransactions'));
    }

    /**
     * Menampilkan form tambah transaksi.
     */
    public function create()
    {
        $products = auth()->user()->role === 'admin'
            ? Product::orderBy('name')
                ->get(['id', 'name', 'price', 'stock'])
            : Product::where('user_id', auth()->id())
                ->orderBy('name')
                ->get(['id', 'name', 'price', 'stock']);

        return view('sales-transactions.create', compact('products'));
    }

    /**
     * Menyimpan transaksi penjualan.
     */
    public function store(StoreSalesTransactionRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->qty) {

            return back()
                ->withInput()
                ->with('error', 'Stok produk tidak mencukupi.');

        }

        $transactionCode = $this->generateTransactionCode();

        DB::transaction(function () use ($request, $product, $transactionCode) {

            // Kurangi stok
            $product->decrement('stock', $request->qty);

            // Ambil stok terbaru
            $latestStock = Product::find($product->id)->stock;

            SalesTransaction::create([

                'transaction_code' => $transactionCode,

                'transaction_date' => now()->toDateString(),

                'product_id'       => $product->id,

                'merchant_id'      => auth()->id(),

                'qty'              => $request->qty,

                'ending_stock'     => $latestStock,

            ]);

        });

        return redirect()
            ->route('sales-transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail transaksi.
     */
    public function show(SalesTransaction $salesTransaction)
    {
        return view('sales-transactions.show', compact('salesTransaction'));
    }

    private function generateTransactionCode(): string
    {
        $lastTransaction = SalesTransaction::latest('id')->first();

        $number = $lastTransaction
            ? (int) substr($lastTransaction->transaction_code, -4) + 1
            : 1;

        return 'TRX-' .
            Carbon::now()->format('Ymd') .
            '-' .
            str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}