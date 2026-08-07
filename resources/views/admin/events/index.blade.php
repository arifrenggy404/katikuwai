@extends('admin.layouts.admin')

@section('title', 'Agenda Kegiatan Desa')

@section('content')
<div class="card card-dash p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar Agenda & Kegiatan Desa</h6>
        <a href="{{ route('admin.events.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Tambah Agenda
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Judul Kegiatan</th>
                    <th>Tanggal & Waktu</th>
                    <th>Lokasi</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->title }}</td>
                        <td><span class="badge bg-primary">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }} ({{ $item->time }})</span></td>
                        <td>{{ $item->location }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.events.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.events.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus agenda ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada agenda kegiatan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $events->links() }}
    </div>
</div>
@endsection
