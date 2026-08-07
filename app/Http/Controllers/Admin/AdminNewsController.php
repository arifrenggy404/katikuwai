<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::with('newsCategory')->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::all();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'news_category_id' => 'required|exists:news_categories,id',
            'image' => 'nullable|image|max:5120',
            'is_featured' => 'nullable|boolean',
        ]);

        $author = \App\Models\Author::firstOrCreate(
            ['username' => 'admin'],
            ['name' => 'Admin Desa', 'avatar' => 'authors/default.jpg', 'bio' => 'Administrator Desa Katikuwai']
        );

        $validated['author_id'] = $author->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['is_featured'] = $request->has('is_featured');
        $validated['thumbnail'] = 'news/default.jpg';

        if ($request->hasFile('image')) {
            $validated['thumbnail'] = $request->file('image')->store('news', 'public');
        }

        unset($validated['image']);

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'news_category_id' => 'required|exists:news_categories,id',
            'image' => 'nullable|image|max:5120',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $validated['thumbnail'] = $request->file('image')->store('news', 'public');
        }

        unset($validated['image']);

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}
