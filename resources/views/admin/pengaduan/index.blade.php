@extends('admin.layouts.admin')

@section('title', 'Kelola Pengaduan')

@section('content')
<div class="card card-dash p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar Pengaduan Masyarakat</h6>
    </div>

    <!-- Filter & Search -->
    <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Tiket / Nama / NIK..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">-- Semua Status --</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-sm btn-success w-100"><i class="bi bi-search me-1"></i> Cari</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No. Tiket</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $item)
                    <tr>
                        <td><span class="badge bg-light text-dark border">{{ $item->nomor_tiket }}</span></td>
                        <td class="fw-semibold">{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->nik }}</td>
                        <td><span class="badge bg-secondary">{{ $item->kategori }}</span></td>
                        <td>
                            @if($item->status == 'Pending')
                                <span class="badge bg-danger">Pending</span>
                            @elseif($item->status == 'Diproses')
                                <span class="badge bg-warning text-dark">Diproses</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.pengaduan.show', $item->id) }}" class="btn btn-sm btn-outline-info me-1"><i class="bi bi-eye"></i> Detail</a>
                            <form action="{{ route('admin.pengaduan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengaduan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada pengaduan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $pengaduans->links() }}
    </div>
</div>
@endsection
