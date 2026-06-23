<?php

namespace App\Http\Controllers;

use App\Models\LetterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LetterRequestController extends Controller
{
    public function create()
    {
        return view('pages.letter_request.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'phone' => 'required|string|max:20',
            'letter_type' => 'required|string',
            'purpose' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // Max 5MB
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus berjumlah 16 digit.',
            'phone.required' => 'Nomor HP/WA wajib diisi.',
            'letter_type.required' => 'Pilih jenis surat terlebih dahulu.',
            'purpose.required' => 'Tuliskan keperluan pengajuan surat Anda.',
            'attachment.max' => 'Ukuran berkas pendukung maksimal 5 MB.',
            'attachment.mimes' => 'Format berkas pendukung harus berupa JPG, JPEG, PNG, atau PDF.',
        ]);

        // Generate unique ticket number: e.g., SRT-20260622-AB12D
        $ticketNumber = 'SRT-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        while (LetterRequest::where('ticket_number', $ticketNumber)->exists()) {
            $ticketNumber = 'SRT-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        }

        $validated['ticket_number'] = $ticketNumber;
        $validated['status'] = 'pending';

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('letter_attachments', 'public');
            $validated['attachment'] = $path;
        }

        LetterRequest::create($validated);

        return redirect()->back()->with('success_ticket', [
            'ticket' => $ticketNumber,
            'name' => $validated['name'],
            'type' => $validated['letter_type']
        ]);
    }

    public function checkStatus(Request $request)
    {
        $code = strtoupper(trim($request->input('code')));

        // If it starts with TKT-, redirect to the complaint status checker
        if ($code && str_starts_with($code, 'TKT-')) {
            return redirect()->route('pengaduan.check-status', ['code' => $code]);
        }

        if (!$code) {
            return redirect()->route('pengaduan')->with('error', 'Silakan masukkan nomor tiket pengajuan surat Anda.');
        }

        $letterRequest = LetterRequest::where('ticket_number', $code)->first();

        if (!$letterRequest) {
            return redirect()->route('pengaduan')->with('error', 'Nomor Tiket "' . $code . '" tidak ditemukan.');
        }

        return view('pages.letter_request.status_detail', compact('letterRequest'));
    }
}
