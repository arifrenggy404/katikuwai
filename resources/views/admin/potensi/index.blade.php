@extends('admin.layouts.admin')

@section('title', 'Potensi Desa')

@section('content')
<div class="card card-dash p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar Potensi Desa</h6>
        <a href="{{ route('admin.potensi.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Tambah Potensi
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="80">Gambar</th>
                    <th>Judul Potensi</th>
                    <th>Deskripsi</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($potensi as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="rounded" width="60" height="45" style="object-fit: cover;">
                            @else
                                <span class="badge bg-light text-muted border">No Img</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->title }}</td>
                        <td class="text-truncate" style="max-width: 300px;">{{ $item->description }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.potensi.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.potensi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus potensi desa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada potensi desa yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $potensi->links() }}
    </div>
</div>
@endsection
