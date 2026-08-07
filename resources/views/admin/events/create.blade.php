@extends('admin.layouts.admin')

@section('title', 'Tambah Agenda Kegiatan')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Tambah Agenda Kegiatan</h6>
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Kegiatan</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Tanggal Kegiatan</label>
                <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Waktu / Jam</label>
                <input type="text" name="time" class="form-control" placeholder="misal: 09:00 WITA" value="{{ old('time') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Lokasi Tempat</label>
            <input type="text" name="location" class="form-control" placeholder="misal: Balai Desa Katiku Wai" value="{{ old('location') }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Deskripsi Kegiatan</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Simpan Agenda</button>
    </form>
</div>
@endsection
