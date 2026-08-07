@extends('admin.layouts.admin')

@section('title', 'Buat Album Galeri Baru')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Buat Album Kegiatan</h6>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Album Kegiatan</label>
            <input type="text" name="title" class="form-control" placeholder="misal: Dokumentasi HUT RI Ke-81 Desa Katikuwai" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Foto Sampul Album (Cover)</label>
            <input type="file" name="cover_image" class="form-control" accept="image/*">
            <small class="text-muted">Biarkan kosong jika ingin otomatis menggunakan foto pertama yang diupload.</small>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Deskripsi Album</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Keterangan singkat kegiatan...">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Buat Album & Lanjut Upload Foto</button>
    </form>
</div>
@endsection
