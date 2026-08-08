@extends('admin.layouts.admin')

@section('title', 'Tambah Data Statistik')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Tambah Data Statistik & Demografi</h6>
        <a href="{{ route('admin.demographics.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.demographics.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori Statistik</label>
            <input type="text" name="category" class="form-control" list="categoryOptions" placeholder="misal: pekerjaan / pendidikan / usia / agama / dusun" value="{{ old('category') }}" required>
            <datalist id="categoryOptions">
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
            <input type="text" name="label" class="form-control" placeholder="misal: Petani / SMA / 18-35 Tahun / Islam / Dusun I" value="{{ old('label') }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Jumlah (Orang / Jiwa)</label>
            <input type="number" name="value" class="form-control" placeholder="misal: 150" value="{{ old('value') }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Simpan Data Statistik</button>
    </form>
</div>
@endsection
