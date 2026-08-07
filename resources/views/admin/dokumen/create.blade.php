@extends('admin.layouts.admin')

@section('title', 'Upload Dokumen Baru')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Upload Dokumen Publik</h6>
        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Dokumen / Peraturan Desa</label>
            <input type="text" name="nama" class="form-control" placeholder="misal: Peraturan Desa No. 02 Tahun 2026" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Pilih File (PDF, DOCX, XLS, ZIP, max 10MB)</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Upload Dokumen</button>
    </form>
</div>
@endsection
