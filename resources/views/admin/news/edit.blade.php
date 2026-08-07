@extends('admin.layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Edit Berita</h6>
        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Berita</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $news->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori Berita</label>
            <select name="news_category_id" class="form-select" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('news_category_id', $news->news_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar Sampul Saat Ini</label>
            @if($news->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $news->image) }}" class="rounded border" width="120">
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="is_featured" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_featured">Tampilkan sebagai Berita Unggulan</label>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Isi Berita</label>
            <textarea name="content" class="form-control" rows="8" required>{{ old('content', $news->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Update Berita</button>
    </form>
</div>
@endsection
