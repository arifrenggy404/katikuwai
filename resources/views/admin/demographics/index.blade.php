@extends('admin.layouts.admin')

@section('title', 'Statistik & Demografi Desa')

@section('content')
<div class="card card-dash p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h6 class="fw-bold mb-1">Data Statistik & Demografi Desa</h6>
            <small class="text-muted">Kelola rincian data pekerjaan, pendidikan, kelompok usia, agama, dll.</small>
        </div>
        <a href="{{ route('admin.demographics.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Tambah Data Statistik
        </a>
    </div>

    <!-- Filter Form -->
    <form action="{{ route('admin.demographics.index') }}" method="GET" class="row g-2 mb-3 align-items-center">
        <div class="col-md-4">
            <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">-- Semua Kategori Statistik --</option>
                @foreach($categories as $c)
                    <option value="{{ $c }}" {{ request('category') == $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                @endforeach
            </select>
        </div>
        @if(request('category'))
            <div class="col-md-2">
                <a href="{{ route('admin.demographics.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Reset Filter</a>
            </div>
        @endif
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Kategori Statistik</th>
                    <th>Label / Kelompok</th>
                    <th>Jumlah (Jiwa / KK / Satuan)</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demographics as $item)
                    <tr>
                        <td><span class="badge bg-info text-dark">{{ ucfirst($item->category) }}</span></td>
                        <td class="fw-semibold">{{ $item->label }}</td>
                        <td class="fw-bold text-success">{{ number_format($item->value, 0, ',', '.') }} Jiwa</td>
                        <td class="text-center">
                            <a href="{{ route('admin.demographics.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.demographics.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data statistik ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada data statistik demografi yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $demographics->links() }}
    </div>
</div>
@endsection
