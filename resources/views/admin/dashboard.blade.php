@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <!-- Stat Item -->
    <div class="col-md-3">
        <div class="card card-dash p-3 bg-white border-start border-success border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold">PENGADUAN PENDING</span>
                    <h3 class="fw-bold mb-0 text-danger mt-1">{{ $pendingPengaduan }}</h3>
                </div>
                <div class="bg-danger bg-opacity-10 p-3 rounded-3 text-danger">
                    <i class="bi bi-exclamation-triangle fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Item -->
    <div class="col-md-3">
        <div class="card card-dash p-3 bg-white border-start border-primary border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold">TOTAL PENGADUAN</span>
                    <h3 class="fw-bold mb-0 text-primary mt-1">{{ $totalPengaduan }}</h3>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-3 text-primary">
                    <i class="bi bi-chat-left-dots fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Item -->
    <div class="col-md-3">
        <div class="card card-dash p-3 bg-white border-start border-warning border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold">TOTAL BERITA</span>
                    <h3 class="fw-bold mb-0 text-warning mt-1">{{ $totalNews }}</h3>
                </div>
                <div class="bg-warning bg-opacity-10 p-3 rounded-3 text-warning">
                    <i class="bi bi-newspaper fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Item -->
    <div class="col-md-3">
        <div class="card card-dash p-3 bg-white border-start border-info border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold">PERANGKAT DESA</span>
                    <h3 class="fw-bold mb-0 text-info mt-1">{{ $totalOfficials }}</h3>
                </div>
                <div class="bg-info bg-opacity-10 p-3 rounded-3 text-info">
                    <i class="bi bi-people fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Pengaduan Terbaru -->
    <div class="col-md-6">
        <div class="card card-dash p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-danger"></i>Pengaduan Terbaru</h6>
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-outline-success rounded-pill">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tiket</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPengaduan as $item)
                            <tr>
                                <td><span class="badge bg-light text-dark border">{{ $item->nomor_tiket }}</span></td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>
                                    @if($item->status == 'Pending')
                                        <span class="badge bg-danger">Pending</span>
                                    @elseif($item->status == 'Diproses')
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada pengaduan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Berita Terbaru -->
    <div class="col-md-6">
        <div class="card card-dash p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-newspaper me-2 text-warning"></i>Berita Terbaru</h6>
                <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-success rounded-pill">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentNews as $item)
                            <tr>
                                <td class="text-truncate" style="max-width: 200px;">{{ $item->title }}</td>
                                <td><span class="badge bg-secondary">{{ $item->newsCategory->title ?? '-' }}</span></td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada berita.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
