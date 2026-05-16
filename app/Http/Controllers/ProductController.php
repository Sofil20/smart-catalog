<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->role === 'admin'
            ? Product::with(['category', 'user'])->get()
            : Product::where('user_id', auth()->id())->with('category')->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = auth()->user()->role === 'admin'
            ? Category::with('user')->get()
            : Category::where('user_id', auth()->id())->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image.required' => 'Gambar produk wajib diunggah',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        if (auth()->user()->role !== 'admin' && $product->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = auth()->user()->role === 'admin'
            ? Category::with('user')->get()
            : Category::where('user_id', auth()->id())->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if (auth()->user()->role !== 'admin' && $product->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
        ]);

        $data = $request->only(['name', 'description', 'price', 'category_id']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if (auth()->user()->role !== 'admin' && $product->user_id !== auth()->id()) {
            abort(403);
        }

        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
