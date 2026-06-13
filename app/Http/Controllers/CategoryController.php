<?php

namespace App\Http\Controllers;

use App\Exports\CategoriesExport;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = auth()->user()->role === 'admin'
            ? Category::with('user')->get()
            : Category::where('user_id', auth()->id())->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        if (auth()->user()->role !== 'admin' && $category->user_id !== auth()->id()) {
            abort(403);
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if (auth()->user()->role !== 'admin' && $category->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->only(['name', 'description']));

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        if (auth()->user()->role !== 'admin' && $category->user_id !== auth()->id()) {
            abort(403);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function export()
    {
        $isAdmin = auth()->user()->role === 'admin';
        $fileName = 'kategori_' . date('d-m-Y_H-i-s') . '.xlsx';
        
        return Excel::download(
            new CategoriesExport(auth()->id(), $isAdmin),
            $fileName
        );
    }
}
