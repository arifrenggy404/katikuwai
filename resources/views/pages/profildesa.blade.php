@extends('layouts.app')

@section('title', 'Profil Desa - Desa Harmoni Nusantara')

@section('content')

@php
    $kepalaDesa = $officials->firstWhere('position', 'Kepala Desa');
    $sekdes = $officials->firstWhere('position', 'Sekretaris Desa');
    $kaurKeuangan = $officials->firstWhere('position', 'Kepala Urusan Keuangan');
    $kaurPerencanaan = $officials->firstWhere('position', 'Kepala Urusan Perencanaan');
    $kaurTU = $officials->firstWhere('position', 'Kepala Urusan Tata Usaha');
    $kasiPemerintahan = $officials->firstWhere('position', 'Kepala Seksi Pemerintahan');
    $kasiKesejahteraan = $officials->firstWhere('position', 'Kepala Seksi Kesejahteraan');
    $kasiPelayanan = $officials->firstWhere('position', 'Kepala Seksi Pelayanan');
    $ketuaBPD = $officials->firstWhere('position', 'Ketua BPD') ?? $officials->where('group', 'bpd')->first();
    $dusunList = $officials->where('group', 'dusun')->sortBy('order');
@endphp

<!-- Hero Banner -->
<div class="mt-1 hero-section h-64 md:h-30 flex items-center justify-center bg-blue-900">
    <div class="text-center px-4 ">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Profil {{ $setting?->desa_name ?? 'Desa Katiku Wai' }}</h2>
        <p class="text-l text-white max-xl mx-auto">Membangun desa yang sejahtera, mandiri, berbudaya dan berdaya daya saing</p>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-12">
    <!-- Profil Desa Section -->
    <section class="mb-16 fade-in">
        <h2 class="text-3xl font-bold text-blue-900 mb-8 text-center relative pb-4">
            Profil Desa
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-blue-900 rounded-full"></span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Visi Misi -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-blue-100">
                <div class="bg-blue-900 px-6 py-4">
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <i data-feather="target" class="mr-2"></i> Visi & Misi
                    </h3>
                </div>
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-blue-900 mb-3">Visi Desa</h4>
                    <p class="text-gray-700 mb-6">"{{ $setting?->desa_vision ?? 'Terwujudnya Desa Katiku Wai yang Sejahtera, Berbudaya, dan Mandiri Melalui Pemanfaatan Potensi Lokal dan Infrastruktur yang Berkelanjutan.' }}"</p>

                    <h4 class="text-lg font-semibold text-blue-900 mb-3">Misi Desa</h4>
                    <ul class="space-y-2 text-gray-700">
                        @if($setting && $setting->desa_mission)
                            @foreach(explode("\n", str_replace("\r", "", $setting->desa_mission)) as $misiItem)
                                @if(trim($misiItem))
                                    <li class="flex items-start">
                                        <i data-feather="check-circle" class="text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                        <span>{{ trim($misiItem) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        @else
                            <li class="flex items-start">
                                <i data-feather="check-circle" class="text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Meningkatkan kualitas pelayanan publik dan tata kelola desa yang bersih serta transparan.</span>
                            </li>
                            <li class="flex items-start">
                                <i data-feather="check-circle" class="text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Mengembangkan pertanian dan peternakan lokal yang berkelanjutan.</span>
                            </li>
                            <li class="flex items-start">
                                <i data-feather="check-circle" class="text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Melestarikan nilai-nilai adat, budaya, dan kearifan lokal Sumba.</span>
                            </li>
                            <li class="flex items-start">
                                <i data-feather="check-circle" class="text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Meningkatkan akses kesehatan dan pendidikan bagi masyarakat pedalaman.</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Sejarah Desa -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-blue-100">
                <div class="bg-blue-900 px-6 py-4">
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <i data-feather="book" class="mr-2"></i> Sejarah Desa
                    </h3>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <img src="{{ ($setting && $setting->desa_history_image) ? asset('storage/' . $setting->desa_history_image) : 'https://picsum.photos/seed/sejarahdesa/640x360.jpg' }}" alt="Sejarah Desa" class="w-full h-48 object-cover rounded-lg mb-4">
                        <p class="text-gray-700">{{ $setting?->desa_history ?? 'Desa Katiku Wai dibentuk sebagai bagian dari pengembangan wilayah administratif di Sumba Timur untuk mendekatkan akses pelayanan bagi warga pedalaman. Masyarakatnya didominasi oleh suku asli Sumba yang mempertahankan adat istiadat leluhur mereka.' }}</p>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="text-lg font-semibold text-blue-900 mb-2">Asal Usul Nama</h4>
                        <p class="text-gray-700">{{ $setting?->desa_origin ?? 'Nama "Katiku Wai" berasal dari bahasa lokal Sumba yang berarti "Kepala Air" atau "Mata Air", melambangkan kedudukan desa sebagai daerah tangkapan air penting yang menghidupi wilayah di sekitarnya.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Data Umum -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-blue-100">
                <div class="bg-blue-900 px-6 py-4">
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <i data-feather="info" class="mr-2"></i> Data Umum
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-600">Luas Wilayah</p>
                            <p class="text-xl font-bold text-blue-900">{{ $setting?->desa_area ?? '159.1 Km²' }}</p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-600">Jumlah Penduduk</p>
                            <p class="text-xl font-bold text-blue-900">{{ $setting?->desa_population ?? '1.536 Jiwa' }}</p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-600">Jumlah Kepala Keluarga</p>
                            <p class="text-xl font-bold text-blue-900">{{ $setting?->desa_families ?? '384 KK' }}</p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-600">Jumlah RT</p>
                            <p class="text-xl font-bold text-blue-900">{{ $setting?->desa_rt ?? '8' }}</p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-600">Jumlah Dusun</p>
                            <p class="text-xl font-bold text-blue-900">{{ $setting?->desa_dusun ?? '3' }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-lg font-semibold text-blue-900 mb-3">Batas Wilayah</h4>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-center">
                                <i data-feather="compass" class="text-blue-500 mr-2"></i>
                                <span><span class="font-medium">Utara:</span> {{ $setting?->bound_north ?? 'Kecamatan Pandawai' }}</span>
                            </li>
                            <li class="flex items-center">
                                <i data-feather="compass" class="text-blue-500 mr-2"></i>
                                <span><span class="font-medium">Timur:</span> {{ $setting?->bound_east ?? 'Desa Katiku Luku' }}</span>
                            </li>
                            <li class="flex items-center">
                                <i data-feather="compass" class="text-blue-500 mr-2"></i>
                                <span><span class="font-medium">Selatan:</span> {{ $setting?->bound_south ?? 'Desa Nggoni (Kecamatan Karera)' }}</span>
                            </li>
                            <li class="flex items-center">
                                <i data-feather="compass" class="text-blue-500 mr-2"></i>
                                <span><span class="font-medium">Barat:</span> {{ $setting?->bound_west ?? 'Desa Katiku Tana' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demographics & APBDes Budget Transparency Section -->
    <section class="py-12 px-4 max-w-7xl mx-auto fade-in" x-data="{ activeTab: 'demografi' }">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 border-b border-blue-100 pb-4">
            <h2 class="text-3xl font-bold text-blue-900 relative">
                Data & Transparansi Desa
                <span class="absolute bottom-[-8px] left-0 w-24 h-1 bg-blue-600 rounded-full"></span>
            </h2>
            <div class="flex space-x-2 mt-4 md:mt-0">
                <button 
                    @click="activeTab = 'demografi'"
                    :class="activeTab === 'demografi' ? 'bg-blue-900 text-white' : 'bg-white text-blue-900 border border-blue-200 hover:bg-blue-50'"
                    class="px-5 py-2.5 rounded-lg font-semibold transition text-sm flex items-center shadow-sm">
                    <i data-feather="users" class="w-4 h-4 mr-2"></i> Statistik Kependudukan
                </button>
                <button 
                    @click="activeTab = 'apbdes'"
                    :class="activeTab === 'apbdes' ? 'bg-blue-900 text-white' : 'bg-white text-blue-900 border border-blue-200 hover:bg-blue-50'"
                    class="px-5 py-2.5 rounded-lg font-semibold transition text-sm flex items-center shadow-sm">
                    <i data-feather="dollar-sign" class="w-4 h-4 mr-2"></i> Transparansi APBDes
                </button>
            </div>
        </div>

        <!-- Tab Content: Demografi -->
        <div x-show="activeTab === 'demografi'" x-transition.opacity class="bg-white rounded-xl shadow-lg border border-blue-100 p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Gender & Usia -->
                <div class="space-y-8">
                    <div>
                        <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                            <span class="w-2 h-6 bg-blue-600 rounded-full mr-2"></span> Berdasarkan Jenis Kelamin
                        </h3>
                        <div class="flex items-center justify-center p-4 bg-gray-50 rounded-xl" style="height: 280px; position: relative;">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                            <span class="w-2 h-6 bg-blue-600 rounded-full mr-2"></span> Rentang Usia
                        </h3>
                        <div class="flex items-center justify-center p-4 bg-gray-50 rounded-xl" style="height: 280px; position: relative;">
                            <canvas id="usiaChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Pekerjaan & Pendidikan -->
                <div class="space-y-8">
                    <div>
                        <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                            <span class="w-2 h-6 bg-blue-600 rounded-full mr-2"></span> Mata Pencaharian
                        </h3>
                        <div class="flex items-center justify-center p-4 bg-gray-50 rounded-xl" style="height: 280px; position: relative;">
                            <canvas id="pekerjaanChart"></canvas>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                            <span class="w-2 h-6 bg-blue-600 rounded-full mr-2"></span> Tingkat Pendidikan
                        </h3>
                        <div class="flex items-center justify-center p-4 bg-gray-50 rounded-xl" style="height: 280px; position: relative;">
                            <canvas id="pendidikanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Content: APBDes -->
        <div x-show="activeTab === 'apbdes'" x-transition.opacity class="bg-white rounded-xl shadow-lg border border-blue-100 p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Summary & Chart -->
                <div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                        <span class="w-2 h-6 bg-blue-600 rounded-full mr-2"></span> Perbandingan Anggaran
                    </h3>
                    <div class="flex items-center justify-center p-4 bg-gray-50 rounded-xl mb-6" style="height: 300px; position: relative;">
                        <canvas id="apbdesComparisonChart"></canvas>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-green-50 border border-green-150 p-4 rounded-xl">
                            <p class="text-xs text-green-700 font-semibold uppercase tracking-wider">Total Pendapatan</p>
                            <p class="text-xl sm:text-2xl font-extrabold text-green-900 mt-1 break-all">Rp {{ number_format($budgets->where('type', 'pendapatan')->sum('amount'), 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-red-50 border border-red-150 p-4 rounded-xl">
                            <p class="text-xs text-red-700 font-semibold uppercase tracking-wider">Total Belanja</p>
                            <p class="text-xl sm:text-2xl font-extrabold text-red-900 mt-1 break-all">Rp {{ number_format($budgets->where('type', 'belanja')->sum('amount'), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Details Breakdown -->
                <div class="space-y-6">
                    <div>
                        <h4 class="text-lg font-bold text-green-900 mb-3 flex items-center">
                            <i data-feather="trending-up" class="w-5 h-5 text-green-600 mr-2"></i> Rincian Pendapatan (2026)
                        </h4>
                        <div class="space-y-4">
                            @forelse($budgets->where('type', 'pendapatan') as $item)
                                <div>
                                    <div class="flex justify-between text-sm font-semibold text-gray-700 mb-1">
                                        <span>{{ $item->category }}</span>
                                        <span>Rp {{ number_format($item->amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                                        @php
                                            $totalP = $budgets->where('type', 'pendapatan')->sum('amount');
                                            $pctP = $totalP > 0 ? ($item->amount / $totalP) * 100 : 0;
                                        @endphp
                                        <div class="bg-green-500 h-full rounded-full" style="width: {{ $pctP }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 italic">Data pendapatan belum tersedia.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="border-t border-gray-150 pt-6">
                        <h4 class="text-lg font-bold text-red-900 mb-3 flex items-center">
                            <i data-feather="trending-down" class="w-5 h-5 text-red-600 mr-2"></i> Rincian Belanja (2026)
                        </h4>
                        <div class="space-y-4">
                            @forelse($budgets->where('type', 'belanja') as $item)
                                <div>
                                    <div class="flex justify-between text-sm font-semibold text-gray-700 mb-1">
                                        <span>{{ $item->category }}</span>
                                        <span>Rp {{ number_format($item->amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                                        @php
                                            $totalB = $budgets->where('type', 'belanja')->sum('amount');
                                            $pctB = $totalB > 0 ? ($item->amount / $totalB) * 100 : 0;
                                        @endphp
                                        <div class="bg-red-500 h-full rounded-full" style="width: {{ $pctB }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 italic">Data belanja belum tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Helper to check charts
        const initCharts = () => {
            // 1. Gender Chart
            const genderData = @json($demographics->where('category', 'gender')->values());
            if (genderData.length && document.getElementById('genderChart')) {
                new Chart(document.getElementById('genderChart'), {
                    type: 'doughnut',
                    data: {
                        labels: genderData.map(d => d.label),
                        datasets: [{
                            data: genderData.map(d => d.value),
                            backgroundColor: ['#3b82f6', '#ec4899'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            }

            // 2. Usia Chart
            const usiaData = @json($demographics->where('category', 'usia')->values());
            if (usiaData.length && document.getElementById('usiaChart')) {
                new Chart(document.getElementById('usiaChart'), {
                    type: 'bar',
                    data: {
                        labels: usiaData.map(d => d.label),
                        datasets: [{
                            label: 'Jumlah Penduduk',
                            data: usiaData.map(d => d.value),
                            backgroundColor: '#f59e0b',
                            borderWidth: 0,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true }
                        },
                        plugins: {
                            legend: { display: false }
                        }
                    }
                });
            }

            // 3. Pekerjaan Chart
            const pekerjaanData = @json($demographics->where('category', 'pekerjaan')->values());
            if (pekerjaanData.length && document.getElementById('pekerjaanChart')) {
                new Chart(document.getElementById('pekerjaanChart'), {
                    type: 'bar',
                    data: {
                        labels: pekerjaanData.map(d => d.label),
                        datasets: [{
                            label: 'Jumlah Orang',
                            data: pekerjaanData.map(d => d.value),
                            backgroundColor: '#10b981',
                            borderWidth: 0,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y',
                        scales: {
                            x: { beginAtZero: true }
                        },
                        plugins: {
                            legend: { display: false }
                        }
                    }
                });
            }

            // 4. Pendidikan Chart
            const pendidikanData = @json($demographics->where('category', 'pendidikan')->values());
            if (pendidikanData.length && document.getElementById('pendidikanChart')) {
                new Chart(document.getElementById('pendidikanChart'), {
                    type: 'pie',
                    data: {
                        labels: pendidikanData.map(d => d.label),
                        datasets: [{
                            data: pendidikanData.map(d => d.value),
                            backgroundColor: ['#6366f1', '#a855f7', '#ec4899', '#f43f5e', '#ef4444'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            }

            // 5. APBDes Comparison Chart
            const totalPendapatan = {{ $budgets->where('type', 'pendapatan')->sum('amount') ?? 0 }};
            const totalBelanja = {{ $budgets->where('type', 'belanja')->sum('amount') ?? 0 }};
            if ((totalPendapatan > 0 || totalBelanja > 0) && document.getElementById('apbdesComparisonChart')) {
                new Chart(document.getElementById('apbdesComparisonChart'), {
                    type: 'bar',
                    data: {
                        labels: ['Pendapatan', 'Belanja'],
                        datasets: [{
                            data: [totalPendapatan, totalBelanja],
                            backgroundColor: ['#10b981', '#ef4444'],
                            borderWidth: 0,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Total: Rp ' + context.raw.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            }
        };
        initCharts();
    });
    </script>

    <!-- Struktur Organisasi Desa Section -->
    <section class="py-16 px-4 max-w-7xl mx-auto">
        <h2 class="center text-3xl font-bold text-blue-900 mb-12 text-center relative">
            Struktur Organisasi Pemerintahan<br>{{ $setting?->desa_name ?? 'Desa Katiku Wai' }}
            <span class="absolute bottom-[-10px] left-1/2 transform -translate-x-1/2 w-24 h-1 bg-blue-600 rounded-full"></span>
        </h2>>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-blue-100 p-8">
            <!-- Kepala Desa -->
            <div class="flex flex-col items-center justify-center mb-16">
                <div class="w-40 h-40 rounded-full overflow-hidden border-4 border-blue-900 mb-5 shadow-lg">
                    <img src="{{ $kepalaDesa && $kepalaDesa->photo ? asset('storage/' . $kepalaDesa->photo) : asset('images/gambar.jpeg') }}" alt="Kepala Desa" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-semibold text-blue-900 mb-3">{{ $kepalaDesa ? $kepalaDesa->position : 'Kepala Desa' }}</h3>
                <div class="bg-blue-900 text-white px-6 py-3 rounded-lg">
                    <p class="font-bold">{{ $kepalaDesa ? $kepalaDesa->name : 'BELUM DIATUR' }}</p>
                </div>
            </div>

            <!-- Level Kedua -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div class="text-center">
                    <div class="w-28 h-28 rounded-full overflow-hidden border-3 border-blue-600 mx-auto mb-4 shadow-md">
                        <img src="{{ $sekdes && $sekdes->photo ? asset('storage/' . $sekdes->photo) : asset('images/gambar.jpeg') }}" alt="Sekretaris Desa" class="w-full h-full object-cover">
                    </div>
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">{{ $sekdes ? $sekdes->position : 'Sekretaris Desa' }}</h4>
                    <div class="bg-blue-100 px-4 py-2 rounded-lg">
                        <p class="font-medium">{{ $sekdes ? $sekdes->name : 'BELUM DIATUR' }}</p>
                    </div>
                </div>

                <div class="text-center">
                    <div class="w-28 h-28 rounded-full overflow-hidden border-3 border-blue-600 mx-auto mb-4 shadow-md">
                        <img src="{{ $kaurKeuangan && $kaurKeuangan->photo ? asset('storage/' . $kaurKeuangan->photo) : asset('images/gambar.jpeg') }}" alt="Kepala Urusan Keuangan" class="w-full h-full object-cover">
                    </div>
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">{{ $kaurKeuangan ? $kaurKeuangan->position : 'Kepala Urusan Keuangan' }}</h4>
                    <div class="bg-blue-100 px-4 py-2 rounded-lg">
                        <p class="font-medium">{{ $kaurKeuangan ? $kaurKeuangan->name : 'BELUM DIATUR' }}</p>
                    </div>
                </div>

                <div class="text-center">
                    <div class="w-28 h-28 rounded-full overflow-hidden border-3 border-blue-600 mx-auto mb-4 shadow-md">
                        <img src="{{ $kaurPerencanaan && $kaurPerencanaan->photo ? asset('storage/' . $kaurPerencanaan->photo) : asset('images/gambar.jpeg') }}" alt="Kepala Urusan Perencanaan" class="w-full h-full object-cover">
                    </div>
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">{{ $kaurPerencanaan ? $kaurPerencanaan->position : 'Kepala Urusan Perencanaan' }}</h4>
                    <div class="bg-blue-100 px-4 py-2 rounded-lg">
                        <p class="font-medium">{{ $kaurPerencanaan ? $kaurPerencanaan->name : 'BELUM DIATUR' }}</p>
                    </div>
                </div>

                <div class="text-center">
                    <div class="w-28 h-28 rounded-full overflow-hidden border-3 border-blue-600 mx-auto mb-4 shadow-md">
                        <img src="{{ $kaurTU && $kaurTU->photo ? asset('storage/' . $kaurTU->photo) : asset('images/gambar.jpeg') }}" alt="Kepala Urusan Tata Usaha" class="w-full h-full object-cover">
                    </div>
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">{{ $kaurTU ? $kaurTU->position : 'Kepala Urusan Tata Usaha' }}</h4>
                    <div class="bg-blue-100 px-4 py-2 rounded-lg">
                        <p class="font-medium">{{ $kaurTU ? $kaurTU->name : 'BELUM DIATUR' }}</p>
                    </div>
                </div>
            </div>

            <!-- Level Ketiga -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
                <div class="text-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-blue-400 mx-auto mb-3 shadow-md">
                        <img src="{{ $kasiPemerintahan && $kasiPemerintahan->photo ? asset('storage/' . $kasiPemerintahan->photo) : asset('images/gambar.jpeg') }}" alt="Kepala Seksi Pemerintahan" class="w-full h-full object-cover">
                    </div>
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">{{ $kasiPemerintahan ? $kasiPemerintahan->position : 'Kepala Seksi Pemerintahan' }}</h4>
                    <div class="bg-blue-50 px-4 py-2 rounded-lg">
                        <p class="font-medium">{{ $kasiPemerintahan ? $kasiPemerintahan->name : 'BELUM DIATUR' }}</p>
                    </div>
                </div>

                <div class="text-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-blue-400 mx-auto mb-3 shadow-md">
                        <img src="{{ $kasiKesejahteraan && $kasiKesejahteraan->photo ? asset('storage/' . $kasiKesejahteraan->photo) : asset('images/gambar.jpeg') }}" alt="Kepala Seksi Kesejahteraan" class="w-full h-full object-cover">
                    </div>
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">{{ $kasiKesejahteraan ? $kasiKesejahteraan->position : 'Kepala Seksi Kesejahteraan' }}</h4>
                    <div class="bg-blue-50 px-4 py-2 rounded-lg">
                        <p class="font-medium">{{ $kasiKesejahteraan ? $kasiKesejahteraan->name : 'BELUM DIATUR' }}</p>
                    </div>
                </div>

                <div class="text-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-blue-400 mx-auto mb-3 shadow-md">
                        <img src="{{ $kasiPelayanan && $kasiPelayanan->photo ? asset('storage/' . $kasiPelayanan->photo) : asset('images/gambar.jpeg') }}" alt="Kepala Seksi Pelayanan" class="w-full h-full object-cover">
                    </div>
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">{{ $kasiPelayanan ? $kasiPelayanan->position : 'Kepala Seksi Pelayanan' }}</h4>
                    <div class="bg-blue-50 px-4 py-2 rounded-lg">
                        <p class="font-medium">{{ $kasiPelayanan ? $kasiPelayanan->name : 'BELUM DIATUR' }}</p>
                    </div>
                </div>
            </div>

            <!-- BPD -->
            <div class="flex flex-col items-center justify-center mb-16">
                <div class="w-28 h-28 rounded-full overflow-hidden border-3 border-blue-500 mx-auto mb-4 shadow-md">
                    <img src="{{ $ketuaBPD && $ketuaBPD->photo ? asset('storage/' . $ketuaBPD->photo) : asset('images/gambar.jpeg') }}" alt="Ketua BPD" class="w-full h-full object-cover">
                </div>
                <h4 class="text-xl font-semibold text-blue-900 mb-3">Badan Permusyawaratan Desa (BPD)</h4>
                <div class="bg-blue-50 px-6 py-2 rounded-lg">
                    <p class="font-medium">Ketua: {{ $ketuaBPD ? $ketuaBPD->name : 'BELUM DIATUR' }}</p>
                </div>
            </div>

            <!-- RW dan RT -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($dusunList as $dusunItem)
                    <div class="text-center">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-gray-400 mx-auto mb-3 shadow-md">
                            <img src="{{ $dusunItem->photo ? asset('storage/' . $dusunItem->photo) : asset('images/gambar.jpeg') }}" alt="{{ $dusunItem->position }}" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-semibold text-blue-900 mb-2">{{ $dusunItem->position }}</h4>
                        <div class="bg-gray-50 px-4 py-2 rounded-lg">
                            <p class="font-medium">{{ $dusunItem->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Potensi Desa Section -->
    <section class="mb-16 fade-in">
        <h2 class="text-3xl font-bold text-blue-900 mb-8 text-center relative pb-4">
            Potensi Desa
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-blue-600 rounded-full"></span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach ( $potensiDesa as $item )
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-blue-100 hover:shadow-lg transition">
                <img src="{{ asset ('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-900 mb-2">{{ $item->title }}</h3>
                    <p class="text-gray-700">{{ $item->description }}</p>
                </div>
            </div>
            @endforeach


        </div>
    </section>

    <!-- Peta Desa Section -->
    <section class="mb-20 fade-in">
        <h2 class="text-3xl font-bold text-blue-900 mb-8 text-center relative pb-4">
            Lokasi Desa
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-blue-600 rounded-full"></span>
        </h2>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-blue-100">
            <div class="relative" style="height: 650px;">
                <iframe
                    src="{{ $setting && $setting->desa_maps_link ? $setting->desa_maps_link : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5194.5642165465!2d104.32477346012963!3d-2.880936989917987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b031054462161%3A0xed05d357ef579aa4!2sKantor%20Desa!5e0!3m2!1sen!2sid!4v1759804386834!5m2!1sen!2sid' }}"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-full">
                </iframe>
                <div class="absolute bottom-0 left-0 right-0 bg-white/90 backdrop-blur-sm p-4 flex flex-col items-center">
                    <a href="{{ $setting && $setting->desa_maps_link ? $setting->desa_maps_link : 'https://www.google.com/maps/dir//Kantor+Desa+48CG%2B349+Air+Senggiris+Kec.+Banyuasin+III,+Kab.+Banyuasin,+Sumatera+Selatan+30958/@-2.8798382,104.3253555,14z/data=!4m5!4m4!1m0!1m2!1m1!1s0x2e3b031054462161:0xed05d357ef579aa4' }}" target="_blank" class="px-6 py-2 bg-blue-900 mt-6 text-white rounded-lg hover:bg-blue-800 transition">
                        Lihat Peta Lengkap
                    </a>
                    <p class="text-gray-600 mt-4 mb-6 text-sm">Aktifkan lokasi untuk melihat peta interaktif</p>
        </div>
    </section>
</div>

<script>
    feather.replace();

    // Animasi scroll
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('section');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeIn');
                }
            });
        }, {
            threshold: 0.1
        });

        sections.forEach(section => {
            section.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            observer.observe(section);
        });

        // Tambahkan class ketika muncul di viewport
        const animateFadeIn = () => {
            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (sectionTop < windowHeight * 0.75) {
                    section.classList.remove('opacity-0');
                    section.classList.add('animate-fadeIn');
                }
            });
        };

        window.addEventListener('scroll', animateFadeIn);
        animateFadeIn(); // Jalankan sekali saat load
    });
</script>
@endsection