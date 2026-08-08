@extends('admin.layouts.admin')

@section('title', 'Tambah Anggaran Dana Desa')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Tambah Anggaran APBDes</h6>
        <a href="{{ route('admin.budgets.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

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
            <label class="form-label fw-semibold">Kategori / Uraian Pos Anggaran</label>
            <input type="text" name="category" class="form-control" placeholder="misal: Dana Desa (DDS), Belanja Pembangunan, dll." value="{{ old('category') }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Nominal Anggaran (Rupiah)</label>
            <div class="input-group">
                <span class="input-group-text bg-light fw-bold">Rp</span>
                <input type="number" step="0.01" name="amount" class="form-control" placeholder="misal: 750000000" value="{{ old('amount') }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Simpan Anggaran</button>
    </form>
</div>
@endsection
