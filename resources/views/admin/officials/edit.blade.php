@extends('admin.layouts.admin')

@section('title', 'Edit Perangkat Desa')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Form Edit Perangkat Desa</h6>
        <a href="{{ route('admin.officials.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.officials.update', $official->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $official->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jabatan</label>
            <input type="text" name="position" class="form-control" value="{{ old('position', $official->position) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kelompok/Struktur</label>
            <select name="group" class="form-select" required>
                <option value="pemerintah" {{ old('group', $official->group) == 'pemerintah' ? 'selected' : '' }}>Pemerintah Desa</option>
                <option value="bpd" {{ old('group', $official->group) == 'bpd' ? 'selected' : '' }}>BPD</option>
                <option value="dusun" {{ old('group', $official->group) == 'dusun' ? 'selected' : '' }}>Kepala Dusun / RT</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Urutan Tampil (Order)</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $official->order) }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Foto Profil Saat Ini</label>
            @if($official->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $official->photo) }}" class="rounded-circle border" width="80" height="80" style="object-fit: cover;">
                </div>
            @endif
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Update Data</button>
    </form>
</div>
@endsection
