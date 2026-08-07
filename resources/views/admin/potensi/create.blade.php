@extends('admin.layouts.admin')

@section('title', 'Tambah Potensi Desa')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Tambah Potensi Desa</h6>
        <a href="{{ route('admin.potensi.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.potensi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Potensi (misal: Wisata / Pertanian / Kerajinan)</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar Foto Potensi</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Deskripsi Potensi</label>
            <textarea name="description" class="form-control" rows="6" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Simpan Potensi</button>
    </form>
</div>
@endsection
