<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDokumenController extends Controller
{
    public function index()
    {
        $dokumens = DokumenDesa::latest()->paginate(10);
        return view('admin.dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        return view('admin.dokumen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip,jpg,png|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('dokumen', 'public');
        }

        DokumenDesa::create($validated);

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen desa berhasil diunggah!');
    }

    public function destroy(DokumenDesa $dokumen)
    {
        if ($dokumen->file) {
            Storage::disk('public')->delete($dokumen->file);
        }
        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen desa berhasil dihapus!');
    }
}
