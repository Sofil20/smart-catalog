<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <style>

        body{
            font-family: DejaVu Sans;
            font-size:12px;
        }

        h2{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table,th,td{
            border:1px solid black;
        }

        th,td{
            padding:8px;
            text-align:left;
        }

        th{
            background:#f2f2f2;
        }

    </style>

</head>

<body>

<h2>

LAPORAN TRANSAKSI PENJUALAN

</h2>

<p>

Tanggal Cetak :
{{ now()->format('d M Y H:i') }}

</p>

<table>

<thead>

<tr>

<th>No</th>
<th>Kode</th>
<th>Tanggal</th>
<th>Merchant</th>
<th>Produk</th>
<th>Harga</th>
<th>Qty</th>
<th>Total</th>

</tr>

</thead>

<tbody>

@php
$total = 0;
@endphp

@foreach($salesTransactions as $item)

@php
$subtotal = $item->product->price * $item->qty;
$total += $subtotal;
@endphp

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->transaction_code }}</td>

<td>{{ \Carbon\Carbon::parse($item->transaction_date)->format('d/m/Y') }}</td>

<td>{{ $item->merchant->name }}</td>

<td>{{ $item->product->name }}</td>

<td>
Rp {{ number_format($item->product->price,0,',','.') }}
</td>

<td>{{ $item->qty }}</td>

<td>
Rp {{ number_format($subtotal,0,',','.') }}
</td>

</tr>

@endforeach

<tr>

<td colspan="7">

<b>Grand Total</b>

</td>

<td>

<b>

Rp {{ number_format($total,0,',','.') }}

</b>

</td>

</tr>

</tbody>

</table>

</body>

</html>