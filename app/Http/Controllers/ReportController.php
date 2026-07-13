<?php

namespace App\Http\Controllers;

use App\Models\SalesTransaction;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan penjualan.
     */
    public function sales()
    {
        $salesTransactions = auth()->user()->role === 'admin'
            ? SalesTransaction::with(['product', 'merchant'])
                ->latest('transaction_date')
                ->get()
            : SalesTransaction::where('merchant_id', auth()->id())
                ->with(['product', 'merchant'])
                ->latest('transaction_date')
                ->get();

        return view('reports.sales', compact('salesTransactions'));
    }

    public function exportExcel()
    {
        return Excel::download(
            new SalesReportExport(),
            'laporan-penjualan.xlsx'
        );
    }

    public function exportPdf()
{
    $salesTransactions = auth()->user()->role === 'admin'
        ? \App\Models\SalesTransaction::with(['product', 'merchant'])
            ->latest('transaction_date')
            ->get()
        : \App\Models\SalesTransaction::where('merchant_id', auth()->id())
            ->with(['product', 'merchant'])
            ->latest('transaction_date')
            ->get();

    $pdf = Pdf::loadView(
        'reports.sales-pdf',
        compact('salesTransactions')
    );

    $pdf->setPaper('A4', 'landscape');

    return $pdf->download('laporan-penjualan.pdf');
}
}