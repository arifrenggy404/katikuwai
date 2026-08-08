@extends('admin.layouts.admin')

@section('title', 'Statistik & Demografi Desa')

@section('content')
<div class="row g-4">
    <!-- Form Tambah Statistik -->
    <div class="col-md-4">
        <div class="card card-dash p-4 bg-white">
            <h6 class="fw-bold mb-3"><i class="bi bi-pie-chart me-2 text-success"></i>Tambah Data Statistik</h6>
            <form action="{{ route('admin.demographics.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori Statistik</label>
                    <input type="text" name="category" class="form-control" list="categoryOptionsStore" placeholder="misal: pekerjaan / pendidikan / usia" value="{{ old('category') }}" required>
                    <datalist id="categoryOptionsStore">
                        <option value="pekerjaan">Pekerjaan</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="usia">Kelompok Usia</option>
                        <option value="agama">Agama</option>
                        <option value="dusun">Wilayah Dusun</option>
                        <option value="perkawinan">Status Perkawinan</option>
                        <option value="golongan_darah">Golongan Darah</option>
                    </datalist>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Label / Sub-Kelompok</label>
                    <input type="text" name="label" class="form-control" placeholder="misal: Petani / SMA / 18-35 Tahun" value="{{ old('label') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Jumlah (Jiwa / Orang)</label>
                    <input type="number" name="value" class="form-control" placeholder="misal: 150" value="{{ old('value') }}" min="0" required>
                </div>

                <button type="submit" class="btn btn-success w-100 rounded-pill"><i class="bi bi-plus-lg me-1"></i> Simpan Statistik</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Statistik -->
    <div class="col-md-8">
        <div class="card card-dash p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Daftar Statistik & Demografi</h6>
            </div>

            <!-- Filter Form -->
            <form action="{{ route('admin.demographics.index') }}" method="GET" class="row g-2 mb-3 align-items-center">
                <div class="col-md-8">
                    <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Kategori Statistik --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c }}" {{ request('category') == $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                        @endforeach
                    </select>
                </div>
                @if(request('category'))
                    <div class="col-md-4">
                        <a href="{{ route('admin.demographics.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill w-100">Reset</a>
                    </div>
                @endif
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Kategori</th>
                            <th>Label / Kelompok</th>
                            <th>Jumlah</th>
                            <th width="110" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demographics as $item)
                            <tr>
                                <td><span class="badge bg-info text-dark">{{ ucfirst($item->category) }}</span></td>
                                <td class="fw-semibold">{{ $item->label }}</td>
                                <td class="fw-bold text-success">{{ number_format($item->value, 0, ',', '.') }} Jiwa</td>
                                <td class="text-center">
                                    <!-- Edit Modal Button -->
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModalDemo{{ $item->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <form action="{{ route('admin.demographics.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data statistik ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada data statistik.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $demographics->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Modals (Placed at root level outside transform/card containers) -->
@foreach($demographics as $item)
    <div class="modal text-start" id="editModalDemo{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.demographics.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Edit Data Statistik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori Statistik</label>
                            <input type="text" name="category" class="form-control" value="{{ $item->category }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Label / Sub-Kelompok</label>
                            <input type="text" name="label" class="form-control" value="{{ $item->label }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah (Jiwa / Orang)</label>
                            <input type="number" name="value" class="form-control" value="{{ $item->value }}" min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Update Statistik</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection
