@extends('layouts.app')

@section('title', 'Status Pengajuan Surat ' . $letterRequest->ticket_number . ' - ' . ($setting?->desa_name ?? 'Desa Katiku Wai'))

@section('content')
<!-- Hero Section -->
<div class="hero-section h-64 md:h-30 flex items-center justify-center bg-blue-900 mt-1">
    <div class="text-center px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Detail Status Pengajuan Surat</h2>
        <p class="text-l text-white max-w-xl mx-auto">Pantau riwayat dan evaluasi dokumen permohonan surat administrasi Anda secara transparan.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12 max-w-3xl animate-fadeIn">
    <!-- Status Card Container -->
    <div class="bg-white rounded-xl shadow-lg border border-blue-100 overflow-hidden">
        
        <!-- Header status -->
        <div class="bg-blue-950 px-6 py-5 text-white flex justify-between items-center flex-wrap gap-4">
            <div>
                <span class="text-xs text-blue-300 font-semibold uppercase tracking-wider block mb-1">Nomor Tiket</span>
                <span class="text-2xl font-mono font-bold">{{ $letterRequest->ticket_number }}</span>
            </div>
            <div>
                <span class="text-xs text-blue-300 font-semibold uppercase tracking-wider block mb-1 text-right">Status Saat Ini</span>
                <div class="flex justify-end">
                    @if($letterRequest->status === 'approved')
                        <span class="bg-green-600 text-white text-sm px-4 py-1.5 rounded-full font-bold flex items-center gap-1 shadow">
                            <i class="fas fa-check-circle"></i> Disetujui
                        </span>
                    @elseif($letterRequest->status === 'rejected')
                        <span class="bg-red-600 text-white text-sm px-4 py-1.5 rounded-full font-bold flex items-center gap-1 shadow">
                            <i class="fas fa-times-circle"></i> Ditolak
                        </span>
                    @else
                        <span class="bg-yellow-500 text-white text-sm px-4 py-1.5 rounded-full font-bold flex items-center gap-1 shadow">
                            <i class="fas fa-clock"></i> Sedang Diproses
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detail data -->
        <div class="p-6 md:p-10 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-100 pb-6">
                <div>
                    <span class="text-xs text-gray-500 font-semibold uppercase block mb-1">Nama Pemohon</span>
                    <p class="text-gray-800 font-bold text-lg">{{ $letterRequest->name }}</p>
                </div>
                <div>
                    <span class="text-xs text-gray-500 font-semibold uppercase block mb-1">Nomor NIK</span>
                    <p class="text-gray-800 font-semibold text-base">{{ substr($letterRequest->nik, 0, 4) }}**********{{ substr($letterRequest->nik, -2) }}</p>
                </div>
                <div>
                    <span class="text-xs text-gray-500 font-semibold uppercase block mb-1">Jenis Surat Yang Diajukan</span>
                    <p class="text-gray-800 font-bold text-lg text-blue-900">{{ $letterRequest->letter_type }}</p>
                </div>
                <div>
                    <span class="text-xs text-gray-500 font-semibold uppercase block mb-1">Tanggal Pengajuan</span>
                    <p class="text-gray-800 font-semibold text-base">{{ $letterRequest->created_at->format('d M Y, H:i') }} WITA</p>
                </div>
            </div>

            <!-- Keperluan -->
            <div class="border-b border-gray-100 pb-6">
                <span class="text-xs text-gray-500 font-semibold uppercase block mb-2">Tujuan / Keperluan</span>
                <div class="bg-gray-50 rounded-lg p-4 text-gray-700 leading-relaxed border border-gray-100">
                    {{ $letterRequest->purpose }}
                </div>
            </div>

            <!-- Admin Note / Catatan Evaluasi -->
            <div>
                <span class="text-xs text-gray-500 font-semibold uppercase block mb-2">Catatan Perangkat Desa / Evaluasi</span>
                @if($letterRequest->admin_note)
                    <div class="rounded-lg p-5 border {{ $letterRequest->status === 'approved' ? 'bg-green-50 border-green-200 text-green-800' : ($letterRequest->status === 'rejected' ? 'bg-red-50 border-red-200 text-red-800' : 'bg-yellow-50 border-yellow-200 text-yellow-800') }}">
                        <p class="font-medium text-sm md:text-base leading-relaxed">{{ $letterRequest->admin_note }}</p>
                    </div>
                @else
                    <div class="bg-gray-50 text-gray-500 rounded-lg p-5 text-center border border-gray-100 italic text-sm">
                        Belum ada catatan evaluasi khusus dari perangkat desa. Permohonan Anda sedang dalam antrean review.
                    </div>
                @endif
            </div>

            <!-- Instruksi Pengambilan -->
            @if($letterRequest->status === 'approved')
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 text-blue-950 flex items-start gap-3 shadow-sm animate-pulse">
                    <i class="fas fa-info-circle text-blue-700 text-xl mt-0.5 flex-shrink-0"></i>
                    <div>
                        <h4 class="font-bold text-sm md:text-base mb-1">Instruksi Pengambilan Surat:</h4>
                        <ul class="list-disc list-inside space-y-1 text-sm text-gray-700">
                            <li>Silakan kunjungi Kantor Kepala Desa Katiku Wai pada jam operasional kerja.</li>
                            <li>Tunjukkan Nomor Tiket Anda kepada petugas administrasi pelayanan.</li>
                            <li>Bawa KTP Asli & fotokopi Kartu Keluarga sebagai bukti verifikasi fisik pengambilan berkas.</li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <!-- Footer Card -->
        <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 flex justify-between items-center">
            <a href="/pengaduan" class="text-sm font-semibold text-blue-900 hover:text-blue-800 flex items-center gap-1 transition">
                &larr; Kembali Cek Status
            </a>
            <a href="{{ route('letter-requests.create') }}" class="text-sm font-semibold text-green-700 hover:text-green-800 flex items-center gap-1 transition">
                Ajukan Surat Baru &rarr;
            </a>
        </div>

    </div>
</div>
@endsection
