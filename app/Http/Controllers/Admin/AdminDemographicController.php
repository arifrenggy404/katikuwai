<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Demographic;
use Illuminate\Http\Request;

class AdminDemographicController extends Controller
{
    public function index(Request $request)
    {
        $query = Demographic::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $demographics = $query->orderBy('category', 'asc')->orderBy('label', 'asc')->paginate(15);
        $categories = Demographic::select('category')->distinct()->orderBy('category', 'asc')->pluck('category');

        return view('admin.demographics.index', compact('demographics', 'categories'));
    }

    public function create()
    {
        return view('admin.demographics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
        ]);

        Demographic::create($validated);
        \Illuminate\Support\Facades\Cache::forget('view_demographics');

        return redirect()->route('admin.demographics.index')->with('success', 'Data statistik / demografi berhasil ditambahkan!');
    }

    public function edit(Demographic $demographic)
    {
        return view('admin.demographics.edit', compact('demographic'));
    }

    public function update(Request $request, Demographic $demographic)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
        ]);

        $demographic->update($validated);
        \Illuminate\Support\Facades\Cache::forget('view_demographics');

        return redirect()->route('admin.demographics.index')->with('success', 'Data statistik / demografi berhasil diperbarui!');
    }

    public function destroy(Demographic $demographic)
    {
        $demographic->delete();
        \Illuminate\Support\Facades\Cache::forget('view_demographics');

        return redirect()->route('admin.demographics.index')->with('success', 'Data statistik / demografi berhasil dihapus!');
    }
}
