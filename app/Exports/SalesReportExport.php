<?php

namespace App\Exports;

use App\Models\SalesTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesReportExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = auth()->user()->role === 'admin'
            ? SalesTransaction::with(['product', 'merchant'])
            : SalesTransaction::where('merchant_id', auth()->id())
                ->with(['product', 'merchant']);

        if ($this->startDate) {
            $query->whereDate('transaction_date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('transaction_date', '<=', $this->endDate);
        }

        $transactions = $query->latest('transaction_date')->get();

        return $transactions->map(function ($transaction) {

            return [

                'Kode Transaksi' => $transaction->transaction_code,

                'Tanggal' => $transaction->transaction_date,

                'Merchant' => $transaction->merchant->name,

                'Produk' => $transaction->product->name,

                'Harga' => $transaction->product->price,

                'Qty' => $transaction->qty,

                'Total' => $transaction->product->price * $transaction->qty,

            ];

        });
    }

    public function headings(): array
    {
        return [

            'Kode Transaksi',

            'Tanggal',

            'Merchant',

            'Produk',

            'Harga',

            'Qty',

            'Total',

        ];
    }
}