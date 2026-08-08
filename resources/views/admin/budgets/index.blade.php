@extends('admin.layouts.admin')

@section('title', 'Dana Desa & APBDes')

@section('content')
<div class="card card-dash p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h6 class="fw-bold mb-1">Transparansi Dana Desa & APBDes</h6>
            <small class="text-muted">Kelola rincian anggaran pendapatan, belanja, dan pembiayaan desa.</small>
        </div>
        <a href="{{ route('admin.budgets.create') }}" class="btn btn-success btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Tambah Anggaran
        </a>
    </div>

    <!-- Filter Form -->
    <form action="{{ route('admin.budgets.index') }}" method="GET" class="row g-2 mb-3 align-items-center">
        <div class="col-md-3">
            <select name="year" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">-- Semua Tahun --</option>
                @foreach($years as $y)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>Tahun {{ $y }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">-- Semua Jenis --</option>
                <option value="pendapatan" {{ request('type') == 'pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                <option value="belanja" {{ request('type') == 'belanja' ? 'selected' : '' }}>Belanja</option>
                <option value="pembiayaan" {{ request('type') == 'pembiayaan' ? 'selected' : '' }}>Pembiayaan</option>
            </select>
        </div>
        @if(request('year') || request('type'))
            <div class="col-md-2">
                <a href="{{ route('admin.budgets.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Reset Filter</a>
            </div>
        @endif
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="80">Tahun</th>
                    <th>Jenis Anggaran</th>
                    <th>Kategori / Uraian</th>
                    <th>Jumlah Nominal (Rp)</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($budgets as $item)
                    <tr>
                        <td><span class="badge bg-secondary">Tahun {{ $item->year }}</span></td>
                        <td>
                            @if($item->type == 'pendapatan')
                                <span class="badge bg-success">Pendapatan</span>
                            @elseif($item->type == 'belanja')
                                <span class="badge bg-danger">Belanja</span>
                            @else
                                <span class="badge bg-warning text-dark">Pembiayaan</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->category }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.budgets.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.budgets.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data anggaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data anggaran Dana Desa yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $budgets->links() }}
    </div>
</div>
@endsection
