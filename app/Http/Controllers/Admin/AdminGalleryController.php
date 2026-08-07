<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::withCount('photos')->latest()->paginate(10);
        return view('admin.gallery.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('gallery/covers', 'public');
        }

        $album = GalleryAlbum::create($validated);

        return redirect()->route('admin.gallery.show', $album->id)->with('success', 'Album galeri berhasil dibuat! Silakan upload foto-foto kegiatan.');
    }

    public function show(GalleryAlbum $gallery)
    {
        $gallery->load('photos');
        return view('admin.gallery.show', compact('gallery'));
    }

    public function edit(GalleryAlbum $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, GalleryAlbum $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($gallery->cover_image && Storage::disk('public')->exists($gallery->cover_image)) {
                Storage::disk('public')->delete($gallery->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('gallery/covers', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Album galeri berhasil diperbarui!');
    }

    public function destroy(GalleryAlbum $gallery)
    {
        if ($gallery->cover_image && Storage::disk('public')->exists($gallery->cover_image)) {
            Storage::disk('public')->delete($gallery->cover_image);
        }

        foreach ($gallery->photos as $photo) {
            if ($photo->image && Storage::disk('public')->exists($photo->image)) {
                Storage::disk('public')->delete($photo->image);
            }
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Album galeri beserta foto di dalamnya berhasil dihapus!');
    }

    // Upload Foto ke Dalam Album
    public function storePhoto(Request $request, GalleryAlbum $gallery)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'required|image|max:5120',
        ]);

        $imagePath = $request->file('image')->store('gallery/photos', 'public');

        GalleryPhoto::create([
            'gallery_album_id' => $gallery->id,
            'image' => $imagePath,
            'caption' => $request->caption,
        ]);

        // Auto update album cover if empty
        if (!$gallery->cover_image) {
            $gallery->update(['cover_image' => $imagePath]);
        }

        return redirect()->back()->with('success', 'Foto kegiatan berhasil ditambahkan ke album!');
    }

    // Hapus Foto dari Album
    public function destroyPhoto(GalleryPhoto $photo)
    {
        if ($photo->image && Storage::disk('public')->exists($photo->image)) {
            Storage::disk('public')->delete($photo->image);
        }
        $photo->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus dari album!');
    }
}
