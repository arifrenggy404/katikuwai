@extends('admin.layouts.admin')

@section('title', 'Kelola Banner Web')

@section('content')
<div class="row g-4 mb-5">
    <!-- Form Tambah Home Banner -->
    <div class="col-md-4">
        <div class="card card-dash p-4 bg-white">
            <h6 class="fw-bold mb-3"><i class="bi bi-image me-2 text-success"></i>Tambah Banner Utama (Slide Depan)</h6>
            <form action="{{ route('admin.banners.home.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul / Caption Banner</label>
                    <input type="text" name="title" class="form-control" placeholder="misal: Selamat Datang di Desa Katikuwai" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto Banner (Gambar Rekomendasi 1920x800)</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Urutan Slide (Order)</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}" required>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label fw-semibold" for="is_active">Tampilkan Banner (Aktif)</label>
                </div>

                <button type="submit" class="btn btn-success w-100 rounded-pill"><i class="bi bi-upload me-1"></i> Upload Banner Utama</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Home Banner -->
    <div class="col-md-8">
        <div class="card card-dash p-4 bg-white">
            <h6 class="fw-bold mb-3">Daftar Banner Utama (Hero Slider)</h6>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="100">Banner</th>
                            <th>Judul / Caption</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th width="100" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($homeBanners as $item)
                            <tr>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" class="rounded border" width="90" height="50" style="object-fit: cover;">
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $item->title }}</td>
                                <td><span class="badge bg-secondary">Slide #{{ $item->order }}</span></td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-light text-muted border">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.banners.home.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus banner ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada banner utama.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Section 2: Banner Berita -->
<div class="row g-4">
    <!-- Form Tambah Banner Berita -->
    <div class="col-md-4">
        <div class="card card-dash p-4 bg-white">
            <h6 class="fw-bold mb-3"><i class="bi bi-newspaper me-2 text-warning"></i>Tambah Banner Berita Utama</h6>
            <form action="{{ route('admin.banners.news.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Berita yang Dijadikan Banner</label>
                    <select name="news_id" class="form-select" required>
                        <option value="">-- Pilih Berita --</option>
                        @foreach($allNews as $n)
                            <option value="{{ $n->id }}">{{ $n->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-warning w-100 rounded-pill"><i class="bi bi-star me-1"></i> Jadikan Banner Berita</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Banner Berita -->
    <div class="col-md-8">
        <div class="card card-dash p-4 bg-white">
            <h6 class="fw-bold mb-3">Daftar Banner Berita Unggulan</h6>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="80">Gambar</th>
                            <th>Judul Berita</th>
                            <th>Kategori</th>
                            <th width="100" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($newsBanners as $item)
                            <tr>
                                <td>
                                    @if($item->news && $item->news->thumbnail)
                                        <img src="{{ asset('storage/' . $item->news->thumbnail) }}" class="rounded" width="60" height="40" style="object-fit: cover;">
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $item->news->title ?? 'Berita Telah Dihapus' }}</td>
                                <td><span class="badge bg-info text-dark">{{ $item->news->newsCategory->title ?? '-' }}</span></td>
                                <td class="text-center">
                                    <form action="{{ route('admin.banners.news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus banner berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada banner berita unggulan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
