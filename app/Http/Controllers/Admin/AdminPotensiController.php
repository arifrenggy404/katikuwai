<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PotensiDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPotensiController extends Controller
{
    public function index()
    {
        $potensi = PotensiDesa::latest()->paginate(10);
        return view('admin.potensi.index', compact('potensi'));
    }

    public function create()
    {
        return view('admin.potensi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('potensi', 'public');
        }

        PotensiDesa::create($validated);

        return redirect()->route('admin.potensi.index')->with('success', 'Potensi desa berhasil ditambahkan!');
    }

    public function edit(PotensiDesa $potensi)
    {
        return view('admin.potensi.edit', compact('potensi'));
    }

    public function update(Request $request, PotensiDesa $potensi)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($potensi->image) {
                Storage::disk('public')->delete($potensi->image);
            }
            $validated['image'] = $request->file('image')->store('potensi', 'public');
        }

        $potensi->update($validated);

        return redirect()->route('admin.potensi.index')->with('success', 'Potensi desa berhasil diperbarui!');
    }

    public function destroy(PotensiDesa $potensi)
    {
        if ($potensi->image) {
            Storage::disk('public')->delete($potensi->image);
        }
        $potensi->delete();

        return redirect()->route('admin.potensi.index')->with('success', 'Potensi desa berhasil dihapus!');
    }
}
