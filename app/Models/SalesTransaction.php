<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesTransaction extends Model
{
    protected $fillable = [
    'transaction_code',
    'transaction_date',
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
