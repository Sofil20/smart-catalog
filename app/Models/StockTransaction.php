<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $fillable = [
    'stock_code',
    'stock_date',
    'product_id',
    'merchant_id',
    'qty',
    'ending_stock',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }
}
