@extends('admin.layouts.admin')

@section('title', 'Dana Desa & APBDes')

@section('content')
<div class="row g-4">
    <!-- Form Tambah Anggaran -->
    <div class="col-md-4">
        <div class="card card-dash p-4 bg-white">
            <h6 class="fw-bold mb-3"><i class="bi bi-wallet2 me-2 text-success"></i>Tambah Anggaran Baru</h6>
            <form action="{{ route('admin.budgets.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tahun Anggaran</label>
                    <input type="number" name="year" class="form-control" value="{{ old('year', date('Y')) }}" min="2000" max="2100" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Anggaran</label>
                    <select name="type" class="form-select" required>
                        <option value="pendapatan" {{ old('type') == 'pendapatan' ? 'selected' : '' }}>Pendapatan Desa</option>
                        <option value="belanja" {{ old('type') == 'belanja' ? 'selected' : '' }}>Belanja Desa</option>
                        <option value="pembiayaan" {{ old('type') == 'pembiayaan' ? 'selected' : '' }}>Pembiayaan Desa</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori / Pos Anggaran</label>
                    <input type="text" name="category" class="form-control" placeholder="misal: Dana Desa (DDS)" value="{{ old('category') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Nominal Anggaran (Rp)</label>
                    <input type="number" step="0.01" name="amount" class="form-control" placeholder="misal: 750000000" value="{{ old('amount') }}" required>
                </div>

                <button type="submit" class="btn btn-success w-100 rounded-pill"><i class="bi bi-plus-lg me-1"></i> Simpan Anggaran</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Anggaran -->
    <div class="col-md-8">
        <div class="card card-dash p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Daftar Transparansi APBDes</h6>
            </div>

            <!-- Filter Form -->
            <form action="{{ route('admin.budgets.index') }}" method="GET" class="row g-2 mb-3 align-items-center">
                <div class="col-md-5">
                    <select name="year" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Tahun --</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>Tahun {{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Jenis --</option>
                        <option value="pendapatan" {{ request('type') == 'pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                        <option value="belanja" {{ request('type') == 'belanja' ? 'selected' : '' }}>Belanja</option>
                        <option value="pembiayaan" {{ request('type') == 'pembiayaan' ? 'selected' : '' }}>Pembiayaan</option>
                    </select>
                </div>
                @if(request('year') || request('type'))
                    <div class="col-md-2">
                        <a href="{{ route('admin.budgets.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill w-100">Reset</a>
                    </div>
                @endif
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tahun</th>
                            <th>Jenis</th>
                            <th>Kategori / Uraian</th>
                            <th>Nominal (Rp)</th>
                            <th width="110" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($budgets as $item)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $item->year }}</span></td>
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
                                    <!-- Edit Modal Button -->
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModalBudget{{ $item->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <form action="{{ route('admin.budgets.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data anggaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada data anggaran Dana Desa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Edit Modals (Placed outside table to prevent flickering) -->
            @foreach($budgets as $item)
                <div class="modal text-start" id="editModalBudget{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('admin.budgets.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Data Anggaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Tahun Anggaran</label>
                                        <input type="number" name="year" class="form-control" value="{{ $item->year }}" min="2000" max="2100" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Jenis Anggaran</label>
                                        <select name="type" class="form-select" required>
                                            <option value="pendapatan" {{ $item->type == 'pendapatan' ? 'selected' : '' }}>Pendapatan Desa</option>
                                            <option value="belanja" {{ $item->type == 'belanja' ? 'selected' : '' }}>Belanja Desa</option>
                                            <option value="pembiayaan" {{ $item->type == 'pembiayaan' ? 'selected' : '' }}>Pembiayaan Desa</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Kategori / Pos Anggaran</label>
                                        <input type="text" name="category" class="form-control" value="{{ $item->category }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nominal Anggaran (Rp)</label>
                                        <input type="number" step="0.01" name="amount" class="form-control" value="{{ $item->amount }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Update Anggaran</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-3">
                {{ $budgets->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
