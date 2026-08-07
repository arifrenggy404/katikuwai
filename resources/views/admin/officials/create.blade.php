@extends('admin.layouts.admin')

@section('title', 'Tambah Perangkat Desa')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Tambah Perangkat Desa</h6>
        <a href="{{ route('admin.officials.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.officials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jabatan</label>
            <input type="text" name="position" class="form-control" placeholder="misal: Kepala Desa / Sekretaris Desa" value="{{ old('position') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kelompok/Struktur</label>
            <select name="group" class="form-select" required>
                <option value="pemerintah">Pemerintah Desa</option>
                <option value="bpd">BPD</option>
                <option value="dusun">Kepala Dusun / RT</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Urutan Tampil (Order)</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Foto Profil</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Simpan Data</button>
    </form>
</div>
@endsection
