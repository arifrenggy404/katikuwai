@extends('admin.layouts.admin')

@section('title', 'Tambah Berita Baru')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Tambah Berita</h6>
        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Berita</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori Berita</label>
            <select name="news_category_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('news_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar Sampul</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_featured">Tampilkan sebagai Berita Unggulan</label>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Isi Berita</label>
            <textarea name="content" class="form-control" rows="8" required>{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Simpan Berita</button>
    </form>
</div>
@endsection
