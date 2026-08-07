<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use Illuminate\Http\Request;

class AdminLetterRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = LetterRequest::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $letters = $query->latest()->paginate(10);

        return view('admin.letters.index', compact('letters'));
    }

    public function show(LetterRequest $letter)
    {
        return view('admin.letters.show', compact('letter'));
    }

    public function updateStatus(Request $request, LetterRequest $letter)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $letter->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pengajuan surat berhasil diperbarui!');
    }

    public function destroy(LetterRequest $letter)
    {
        $letter->delete();
        return redirect()->route('admin.letters.index')->with('success', 'Pengajuan surat berhasil dihapus!');
    }
}
