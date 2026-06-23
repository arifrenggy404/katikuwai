@extends('layouts.app')

@section('title', 'Pengajuan Surat Online - ' . ($setting?->desa_name ?? 'Desa Katiku Wai'))

@section('content')
<!-- Hero Section -->
<div class="hero-section h-64 md:h-30 flex items-center justify-center bg-blue-900 mt-1">
    <div class="text-center px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Layanan Mandiri: Pengajuan Surat Online</h2>
        <p class="text-l text-white max-w-xl mx-auto">Ajukan permohonan surat keterangan Anda secara online dengan mudah, aman, dan tanpa dipungut biaya.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12 max-w-4xl">
    <!-- Success Ticket Message -->
    @if(session('success_ticket'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-8 shadow-md mb-8 text-center animate-fadeIn">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-green-900 mb-2">Pengajuan Surat Berhasil Terkirim!</h3>
            <p class="text-gray-700 mb-6">Halo <strong>{{ session('success_ticket')['name'] }}</strong>, pengajuan <strong>{{ session('success_ticket')['type'] }}</strong> Anda sedang kami tinjau.</p>
            
            <div class="bg-white border-2 border-green-200 rounded-lg p-6 max-w-md mx-auto mb-6">
                <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider block mb-2">Nomor Tiket Anda</span>
                <span class="text-3xl font-mono font-bold text-green-700 block tracking-wide select-all">{{ session('success_ticket')['ticket'] }}</span>
            </div>
            
            <p class="text-red-500 font-semibold text-sm mb-6">⚠️ PENTING: Harap simpan / salin Nomor Tiket ini untuk melacak status persetujuan surat Anda di masa mendatang.</p>
            
            <div class="flex justify-center space-x-4">
                <a href="{{ route('letter-requests.create') }}" class="px-6 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition text-sm font-semibold">
                    Ajukan Surat Baru
                </a>
                <a href="/pengaduan" class="px-6 py-2 border border-blue-900 text-blue-900 rounded-lg hover:bg-blue-50 transition text-sm font-semibold">
                    Cek Status Surat
                </a>
            </div>
        </div>
    @else
        <!-- Form Request -->
        <div class="bg-white rounded-xl shadow-lg border border-blue-100 overflow-hidden">
            <div class="bg-blue-950 px-6 py-4 flex items-center text-white">
                <i class="fas fa-file-alt text-xl mr-3"></i>
                <h3 class="text-lg font-bold">Formulir Pengajuan Surat Mandiri</h3>
            </div>
            
            <form action="{{ route('letter-requests.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Pemohon -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-800 mb-2">Nama Lengkap (Sesuai KTP) <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIK Pemohon -->
                    <div>
                        <label for="nik" class="block text-sm font-semibold text-gray-800 mb-2">Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                        <input type="text" id="nik" name="nik" required maxlength="16" value="{{ old('nik') }}"
                            placeholder="16 digit angka KTP"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition @error('nik') border-red-500 @enderror">
                        @error('nik')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Telepon/WA -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-800 mb-2">Nomor HP / WhatsApp Aktif <span class="text-red-500">*</span></label>
                        <input type="text" id="phone" name="phone" required value="{{ old('phone') }}"
                            placeholder="Contoh: 08123456789"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Surat -->
                    <div>
                        <label for="letter_type" class="block text-sm font-semibold text-gray-800 mb-2">Jenis Surat yang Diajukan <span class="text-red-500">*</span></label>
                        <select id="letter_type" name="letter_type" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none bg-white transition @error('letter_type') border-red-500 @enderror">
                            <option value="">-- Pilih Jenis Surat --</option>
                            <option value="Surat Keterangan Domisili" {{ old('letter_type') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                            <option value="Surat Keterangan Tidak Mampu" {{ old('letter_type') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu (SKTM)</option>
                            <option value="Surat Keterangan Usaha" {{ old('letter_type') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha (SKU)</option>
                            <option value="Surat Keterangan Kematian" {{ old('letter_type') == 'Surat Keterangan Kematian' ? 'selected' : '' }}>Surat Keterangan Kematian</option>
                        </select>
                        @error('letter_type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tujuan / Keperluan -->
                <div>
                    <label for="purpose" class="block text-sm font-semibold text-gray-800 mb-2">Tujuan / Keperluan Pengajuan Surat <span class="text-red-500">*</span></label>
                    <textarea id="purpose" name="purpose" required rows="3"
                        placeholder="Tuliskan alasan pengajuan surat Anda (misal: syarat pendaftaran beasiswa anak, pengajuan kredit bank, dll.)"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition @error('purpose') border-red-500 @enderror">{{ old('purpose') }}</textarea>
                    @error('purpose')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Berkas Lampiran Pendukung -->
                <div>
                    <label for="attachment" class="block text-sm font-semibold text-gray-800 mb-1">Unggah Berkas Pendukung (Opsional)</label>
                    <p class="text-xs text-gray-500 mb-2">KTP / Kartu Keluarga / Surat Pengantar RT. Format: JPG, JPEG, PNG, PDF (Maksimal 5 MB)</p>
                    <input type="file" id="attachment" name="attachment"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none bg-gray-50 transition file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-900 hover:file:bg-blue-200 @error('attachment') border-red-500 @enderror">
                    @error('attachment')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <button type="submit"
                        class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg transition duration-200 shadow-md">
                        Kirim Pengajuan Surat
                    </button>
                </div>
            </form>
        </div>

        <!-- Check Status Callout -->
        <div class="mt-8 text-center text-gray-600">
            Sudah pernah mengajukan surat? 
            <a href="/pengaduan" class="text-blue-600 font-semibold hover:underline">Pantau Status Surat Anda di Sini</a>
        </div>
    @endif
</div>
@endsection
