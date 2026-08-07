@extends('admin.layouts.admin')

@section('title', 'Dokumen Publik Desa')

@section('content')
<div class="card card-dash p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar Dokumen & Produk Hukum Desa</h6>
        <a href="{{ route('admin.dokumen.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
            <i class="bi bi-upload me-1"></i> Upload Dokumen
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Dokumen</th>
                    <th>File</th>
                    <th>Tanggal Upload</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dokumens as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->nama }}</td>
                        <td>
                            @if($item->file)
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-file-earmark-arrow-down me-1"></i> Unduh File
                                </a>
                            @else
                                <span class="badge bg-light text-muted border">Tidak Ada File</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.dokumen.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada dokumen yang diunggah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $dokumens->links() }}
    </div>
</div>
@endsection
