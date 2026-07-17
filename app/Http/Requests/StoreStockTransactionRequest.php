<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1|max:9999999999',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists'   => 'Produk tidak ditemukan.',
            'qty.required'        => 'Jumlah wajib diisi.',
            'qty.integer'         => 'Jumlah harus berupa angka.',
            'qty.min'             => 'Jumlah minimal 1.',
        ];
    }
}