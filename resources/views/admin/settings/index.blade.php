@extends('admin.layouts.admin')

@section('title', 'Pengaturan Profil & Footer Desa')

@section('content')
<div class="card card-dash p-4 bg-white max-w-4xl mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0"><i class="bi bi-sliders me-2 text-success"></i>Pengaturan Lengkap Desa, Footer & Maps</h6>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs mb-4" id="settingTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active fw-semibold text-dark" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button"><i class="bi bi-building me-1"></i> Kontak & Footer</button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-semibold text-dark" id="vision-tab" data-bs-toggle="tab" data-bs-target="#vision" type="button"><i class="bi bi-card-text me-1"></i> Visi & Misi</button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-semibold text-dark" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats" type="button"><i class="bi bi-bar-chart me-1"></i> Statistik & Wilayah</button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-semibold text-dark" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button"><i class="bi bi-journal-bookmark me-1"></i> Tentang & Sejarah</button>
            </li>
        </ul>

        <div class="tab-content" id="settingTabsContent">

            <!-- Tab 1: Kontak & Footer & Maps -->
            <div class="tab-pane fade show active" id="general" role="tabpanel">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Desa</label>
                        <input type="text" name="desa_name" class="form-control" value="{{ old('desa_name', $setting->desa_name) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email Desa (Tampil di Footer & Kontak)</label>
                        <input type="email" name="desa_email" class="form-control" value="{{ old('desa_email', $setting->desa_email) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Telepon / Whatsapp Desa</label>
                        <input type="text" name="desa_phone" class="form-control" value="{{ old('desa_phone', $setting->desa_phone) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Logo Desa</label>
                        @if($setting->desa_logo)
                            <div class="mb-1"><img src="{{ asset('storage/' . $setting->desa_logo) }}" height="40"></div>
                        @endif
                        <input type="file" name="desa_logo" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Lengkap (Tampil di Footer)</label>
                    <textarea name="desa_address" class="form-control" rows="2">{{ old('desa_address', $setting->desa_address) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Link Embed Google Maps (URL / iFrame Src)</label>
                    <input type="text" name="desa_maps_link" class="form-control" value="{{ old('desa_maps_link', $setting->desa_maps_link) }}" placeholder="https://www.google.com/maps/embed?pb=...">
                    <small class="text-muted">Masukkan URL Google Maps Embed untuk peta di halaman kontak & profil.</small>
                </div>
            </div>

            <!-- Tab 2: Visi & Misi -->
            <div class="tab-pane fade" id="vision" role="tabpanel">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Visi Desa</label>
                    <textarea name="desa_vision" class="form-control" rows="4">{{ old('desa_vision', $setting->desa_vision) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Misi Desa (Gunakan baris baru / poin 1, 2, dst)</label>
                    <textarea name="desa_mission" class="form-control" rows="6">{{ old('desa_mission', $setting->desa_mission) }}</textarea>
                </div>
            </div>

            <!-- Tab 3: Statistik & Wilayah -->
            <div class="tab-pane fade" id="stats" role="tabpanel">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Luas Wilayah (Km²)</label>
                        <input type="text" name="desa_area" class="form-control" value="{{ old('desa_area', $setting->desa_area) }}" placeholder="159.1 Km²">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Luas Wilayah (Ha)</label>
                        <input type="text" name="desa_area_ha" class="form-control" value="{{ old('desa_area_ha', $setting->desa_area_ha) }}" placeholder="15.910 Ha">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jumlah Penduduk (Jiwa)</label>
                        <input type="text" name="desa_population" class="form-control" value="{{ old('desa_population', $setting->desa_population) }}" placeholder="1.536 Jiwa">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jumlah KK (Kepala Keluarga)</label>
                        <input type="text" name="desa_families" class="form-control" value="{{ old('desa_families', $setting->desa_families) }}" placeholder="384 KK">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jumlah Dusun</label>
                        <input type="text" name="desa_dusun" class="form-control" value="{{ old('desa_dusun', $setting->desa_dusun) }}" placeholder="3">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jumlah RT</label>
                        <input type="text" name="desa_rt" class="form-control" value="{{ old('desa_rt', $setting->desa_rt) }}" placeholder="8">
                    </div>
                </div>

                <h6 class="fw-bold mb-3 border-bottom pb-2">Batas-Batas Wilayah Desa</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Batas Utara</label>
                        <input type="text" name="bound_north" class="form-control" value="{{ old('bound_north', $setting->bound_north) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Batas Timur</label>
                        <input type="text" name="bound_east" class="form-control" value="{{ old('bound_east', $setting->bound_east) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Batas Selatan</label>
                        <input type="text" name="bound_south" class="form-control" value="{{ old('bound_south', $setting->bound_south) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Batas Barat</label>
                        <input type="text" name="bound_west" class="form-control" value="{{ old('bound_west', $setting->bound_west) }}">
                    </div>
                </div>
            </div>

            <!-- Tab 4: Tentang & Sejarah -->
            <div class="tab-pane fade" id="history" role="tabpanel">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tentang Desa (Gambaran Umum)</label>
                    <textarea name="desa_about" class="form-control" rows="4">{{ old('desa_about', $setting->desa_about) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Asal Usul Nama Desa</label>
                    <textarea name="desa_origin" class="form-control" rows="3">{{ old('desa_origin', $setting->desa_origin) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Sejarah Desa</label>
                    <textarea name="desa_history" class="form-control" rows="5">{{ old('desa_history', $setting->desa_history) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto Sejarah / Dokumentasi</label>
                    @if($setting->desa_history_image)
                        <div class="mb-1"><img src="{{ asset('storage/' . $setting->desa_history_image) }}" height="60" class="rounded"></div>
                    @endif
                    <input type="file" name="desa_history_image" class="form-control" accept="image/*">
                </div>
            </div>

        </div>

        <hr class="my-4">
        <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm"><i class="bi bi-check-lg me-1"></i> SIMPAN SEMUA PENGATURAN</button>
    </form>
</div>
@endsection
