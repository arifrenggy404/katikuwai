@extends('admin.layouts.admin')

@section('title', 'Galeri Kegiatan')

@section('content')
<div class="card card-dash p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar Album Galeri Kegiatan Desa</h6>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Buat Album Baru
        </a>
    </div>

    <div class="row g-4 mt-1">
        @forelse($albums as $item)
            <div class="col-md-4">
                <div class="card card-dash bg-white h-100 overflow-hidden border">
                    <div class="position-relative">
                        @if($item->cover_image)
                            <img src="{{ asset('storage/' . $item->cover_image) }}" class="card-img-top" height="180" style="object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 180px;">
                                <i class="bi bi-images fs-1 opacity-50"></i>
                            </div>
                        @endif
                        <span class="position-absolute top-0 end-0 badge bg-dark m-2"><i class="bi bi-image me-1"></i> {{ $item->photos_count }} Foto</span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-bold mb-1">{{ $item->title }}</h6>
                        <p class="text-muted small mb-3 flex-grow-1 text-truncate">{{ $item->description ?? 'Tidak ada deskripsi.' }}</p>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <a href="{{ route('admin.gallery.show', $item->id) }}" class="btn btn-sm btn-primary rounded-pill px-3"><i class="bi bi-folder-symlink me-1"></i> Kelola Foto</a>
                            <div>
                                <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus album beserta seluruh foto di dalamnya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-images fs-1 d-block mb-2 text-secondary"></i>
                Belum ada album galeri kegiatan yang dibuat.
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $albums->links() }}
    </div>
</div>
@endsection
