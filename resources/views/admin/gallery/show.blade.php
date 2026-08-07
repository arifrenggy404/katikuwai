@extends('admin.layouts.admin')

@section('title', 'Kelola Foto Album')

@section('content')
<div class="row g-4 mb-4">
    <!-- Album Details & Upload Form -->
    <div class="col-md-4">
        <div class="card card-dash p-4 bg-white mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Detail Album</h6>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <h5 class="fw-bold text-success mb-2">{{ $gallery->title }}</h5>
            <p class="text-muted small mb-3">{{ $gallery->description ?? 'Tidak ada deskripsi.' }}</p>
        </div>

        <div class="card card-dash p-4 bg-white">
            <h6 class="fw-bold mb-3"><i class="bi bi-upload me-2 text-success"></i>Upload Foto ke Album</h6>
            <form action="{{ route('admin.gallery.photos.store', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Foto</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan / Caption Foto (Opsional)</label>
                    <input type="text" name="caption" class="form-control" placeholder="misal: Penyerahan Hadiah Lomba">
                </div>
                <button type="submit" class="btn btn-success w-100 rounded-pill"><i class="bi bi-plus-lg me-1"></i> Upload Foto</button>
            </form>
        </div>
    </div>

    <!-- Photo Grid -->
    <div class="col-md-8">
        <div class="card card-dash p-4 bg-white">
            <h6 class="fw-bold mb-3">Daftar Foto dalam Album ini ({{ $gallery->photos->count() }} Foto)</h6>
            <div class="row g-3">
                @forelse($gallery->photos as $photo)
                    <div class="col-md-4 col-6">
                        <div class="card bg-white border rounded-3 overflow-hidden h-100 position-relative">
                            <img src="{{ asset('storage/' . $photo->image) }}" class="card-img-top" height="140" style="object-fit: cover;">
                            <div class="p-2 d-flex justify-content-between align-items-center">
                                <small class="text-muted text-truncate me-2">{{ $photo->caption ?? 'Tanpa Caption' }}</small>
                                <form action="{{ route('admin.gallery.photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-1"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="bi bi-image fs-1 d-block mb-2 text-secondary"></i>
                        Belum ada foto yang diupload di album ini. Silakan gunakan form di samping untuk mengunggah foto.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
