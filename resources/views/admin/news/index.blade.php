@extends('admin.layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="card card-dash p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar Berita Desa</h6>
        <a href="{{ route('admin.news.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Tambah Berita
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="60">Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Unggulan</th>
                    <th>Tanggal</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="rounded" width="50" height="40" style="object-fit: cover;">
                            @else
                                <span class="badge bg-light text-muted border">No Img</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->title }}</td>
                        <td><span class="badge bg-info text-dark">{{ $item->newsCategory->title ?? 'Umum' }}</span></td>
                        <td>
                            @if($item->is_featured)
                                <span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i> Ya</span>
                            @else
                                <span class="badge bg-light text-muted border">Tidak</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada berita yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $news->links() }}
    </div>
</div>
@endsection
