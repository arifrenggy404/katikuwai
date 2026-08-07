@extends('admin.layouts.admin')

@section('title', 'Edit Album Galeri')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Edit Album Galeri</h6>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Album Kegiatan</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Foto Sampul Saat Ini</label>
            @if($gallery->cover_image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $gallery->cover_image) }}" class="rounded border" width="120">
                </div>
            @endif
            <input type="file" name="cover_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Deskripsi Album</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $gallery->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Update Album</button>
    </form>
</div>
@endsection
