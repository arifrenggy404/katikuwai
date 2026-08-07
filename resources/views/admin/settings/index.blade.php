@extends('admin.layouts.admin')

@section('title', 'Pengaturan Desa')

@section('content')
<div class="card card-dash p-4 bg-white max-w-2xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0">Pengaturan Identitas & Profile Desa</h6>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Desa</label>
                <input type="text" name="desa_name" class="form-control" value="{{ old('desa_name', $setting->desa_name) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Email Desa</label>
                <input type="email" name="desa_email" class="form-control" value="{{ old('desa_email', $setting->desa_email) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Telepon Desa</label>
                <input type="text" name="desa_phone" class="form-control" value="{{ old('desa_phone', $setting->desa_phone) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Logo Desa</label>
                <input type="file" name="desa_logo" class="form-control" accept="image/*">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Alamat Kantor Desa</label>
            <textarea name="desa_address" class="form-control" rows="2">{{ old('desa_address', $setting->desa_address) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Visi Desa</label>
            <textarea name="desa_vision" class="form-control" rows="3">{{ old('desa_vision', $setting->desa_vision) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Misi Desa</label>
            <textarea name="desa_mission" class="form-control" rows="4">{{ old('desa_mission', $setting->desa_mission) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success px-4 rounded-pill">Simpan Pengaturan</button>
    </form>
</div>
@endsection
