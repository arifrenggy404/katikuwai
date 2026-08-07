<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::withCount('news')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:news_categories,title',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        NewsCategory::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berita berhasil ditambahkan!');
    }

    public function update(Request $request, NewsCategory $category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:news_categories,title,' . $category->id,
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berita berhasil diperbarui!');
    }

    public function destroy(NewsCategory $category)
    {
        if ($category->news()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh berita!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berita berhasil dihapus!');
    }
}
