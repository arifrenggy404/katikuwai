@extends('admin.layouts.admin')

@section('title', 'Detail Pengajuan Surat')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Tiket Surat: {{ $letter->ticket_number }}</h6>
        <a href="{{ route('admin.letters.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <label class="text-muted small">Nama Pemohon</label>
            <p class="fw-semibold mb-0">{{ $letter->name }}</p>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">NIK</label>
            <p class="fw-semibold mb-0">{{ $letter->nik }}</p>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">No. Telepon / WA</label>
            <p class="fw-semibold mb-0">{{ $letter->phone }}</p>
        </div>
        <div class="col-md-6">
            <label class="text-muted small">Jenis Surat</label>
            <p class="fw-semibold mb-0">{{ $letter->letter_type }}</p>
        </div>
    </div>

    <div class="mb-4">
        <label class="text-muted small">Keperluan / Keterangan</label>
        <div class="p-3 bg-light rounded-3 border">
            {{ $letter->purpose ?? 'Tidak ada keterangan tambahan.' }}
        </div>
    </div>

    @if($letter->ktp_file)
        <div class="mb-3">
            <label class="text-muted small">Lampiran KTP/KK</label>
            <div>
                <a href="{{ asset('storage/' . $letter->ktp_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-file-earmark-image me-1"></i> Lihat Berkas Syarat
                </a>
            </div>
        </div>
    @endif

    <hr class="my-4">

    <!-- Update Status Form -->
    <form action="{{ route('admin.letters.updateStatus', $letter->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="form-label fw-bold">Update Status Surat</label>
            <select name="status" class="form-select">
                <option value="pending" {{ $letter->status == 'pending' ? 'selected' : '' }}>Pending (Perlu Diproses)</option>
                <option value="approved" {{ $letter->status == 'approved' ? 'selected' : '' }}>Disetujui (Surat Siap Ambil / Selesai)</option>
                <option value="rejected" {{ $letter->status == 'rejected' ? 'selected' : '' }}>Ditolak (Syarat Tidak Lengkap)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success px-4 rounded-pill">Simpan Persetujuan</button>
    </form>
</div>
@endsection
