@extends('admin.layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Detail Tiket: {{ $pengaduan->nomor_tiket }}</h6>
        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <label class="text-muted small">Nama Pelapor</label>
            <p class="fw-semibold mb-0">{{ $pengaduan->nama_lengkap }}</p>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">NIK</label>
            <p class="fw-semibold mb-0">{{ $pengaduan->nik }}</p>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">Telepon</label>
            <p class="fw-semibold mb-0">{{ $pengaduan->telepon }}</p>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">Kategori</label>
            <p class="fw-semibold mb-0">{{ $pengaduan->kategori }}</p>
        </div>
    </div>

    <div class="mb-4">
        <label class="text-muted small">Isi Pengaduan</label>
        <div class="p-3 bg-light rounded-3 border">
            {{ $pengaduan->isi_pengaduan }}
        </div>
    </div>

    @if($pengaduan->lampiran)
        <div class="mb-4">
            <label class="text-muted small">Lampiran Foto/Dokumen</label>
            <div>
                <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-file-earmark-image me-1"></i> Lihat Lampiran
                </a>
            </div>
        </div>
    @endif

    <hr class="my-4">

    <!-- Update Status Form -->
    <form action="{{ route('admin.pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="form-label fw-bold">Update Status Pengaduan</label>
            <select name="status" class="form-select">
                <option value="Pending" {{ $pengaduan->status == 'Pending' ? 'selected' : '' }}>Pending (Belum Direspon)</option>
                <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}>Diproses (Sedang Ditangani)</option>
                <option value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>Selesai (Sudah Ditangani)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success px-4 rounded-pill">Simpan Status</button>
    </form>
</div>
@endsection
