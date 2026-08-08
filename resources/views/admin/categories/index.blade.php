@extends('admin.layouts.admin')

@section('title', 'Kategori Berita')

@section('content')
<div class="row g-4">
    <!-- Form Tambah Kategori -->
    <div class="col-md-4">
        <div class="card card-dash p-4 bg-white">
            <h6 class="fw-bold mb-3"><i class="bi bi-folder-plus me-2 text-success"></i>Tambah Kategori Baru</h6>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" name="title" class="form-control" placeholder="misal: Pengumuman / Kegiatan" value="{{ old('title') }}" required>
                </div>
                <button type="submit" class="btn btn-success w-100 rounded-pill"><i class="bi bi-plus-lg me-1"></i> Simpan Kategori</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Kategori -->
    <div class="col-md-8">
        <div class="card card-dash p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Daftar Kategori Berita</h6>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Jumlah Berita</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->title }}</td>
                                <td><code>{{ $item->slug }}</code></td>
                                <td><span class="badge bg-info text-dark">{{ $item->news_count }} Berita</span></td>
                                <td class="text-center">
                                    <!-- Edit Button (Bootstrap Modal Trigger) -->
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada kategori berita.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Modals (Placed at root level outside transform/card containers) -->
@foreach($categories as $item)
    <div class="modal text-start" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.categories.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection
