@extends('admin.layouts.admin')

@section('title', 'Perangkat Desa')

@section('content')
<div class="card card-dash p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar Perangkat & Struktur Desa</h6>
        <a href="{{ route('admin.officials.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Tambah Perangkat
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="60">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Kelompok</th>
                    <th>Urutan</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($officials as $item)
                    <tr>
                        <td>
                            @if($item->photo)
                                <img src="{{ asset('storage/' . $item->photo) }}" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                            @else
                                <span class="badge bg-light text-muted border">No Photo</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->name }}</td>
                        <td><span class="badge bg-primary">{{ $item->position }}</span></td>
                        <td><span class="badge bg-secondary">{{ strtoupper($item->group ?? 'Pemerintah') }}</span></td>
                        <td>{{ $item->order }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.officials.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.officials.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus perangkat desa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data perangkat desa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $officials->links() }}
    </div>
</div>
@endsection
