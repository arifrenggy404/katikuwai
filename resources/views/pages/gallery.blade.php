@extends('layouts.app')

@section('title', 'Galeri Foto Kegiatan - ' . ($setting?->desa_name ?? 'Desa Katiku Wai'))

@section('content')
<!-- Hero Section -->
<div class="hero-section h-64 md:h-30 flex items-center justify-center bg-blue-900 mt-1">
    <div class="text-center px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Galeri Foto Kegiatan</h2>
        <p class="text-l text-white max-w-xl mx-auto">Dokumentasi kegiatan pembangunan, sosial, dan peristiwa penting di {{ $setting?->desa_name ?? 'Desa Katiku Wai' }}</p>
    </div>
</div>

<main class="container mx-auto px-4 py-12 max-w-7xl" x-data="{ 
    activeAlbum: 'all',
    lightboxOpen: false,
    lightboxImage: '',
    lightboxCaption: '',
    openLightbox(img, cap) {
        this.lightboxImage = img;
        this.lightboxCaption = cap || '';
        this.lightboxOpen = true;
    }
}">
    <!-- Album Filter Buttons -->
    @if($albums->count() > 0)
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button class="px-6 py-2.5 rounded-full text-sm font-semibold transition"
                :class="activeAlbum === 'all' ? 'bg-blue-950 text-white shadow-md' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50'"
                @click="activeAlbum = 'all'">
                Semua Foto
            </button>
            @foreach($albums as $album)
                <button class="px-6 py-2.5 rounded-full text-sm font-semibold transition"
                    :class="activeAlbum === {{ $album->id }} ? 'bg-blue-950 text-white shadow-md' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50'"
                    @click="activeAlbum = {{ $album->id }}">
                    {{ $album->title }}
                </button>
            @endforeach
        </div>

        <!-- Photo Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($albums as $album)
                @foreach($album->photos as $photo)
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group"
                        x-show="activeAlbum === 'all' || activeAlbum === {{ $album->id }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100">
                        
                        <!-- Image Wrap -->
                        <div class="relative overflow-hidden aspect-video cursor-pointer"
                            @click="openLightbox('{{ asset('storage/' . $photo->image) }}', '{{ $photo->caption }}')">
                            <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->caption ?? $album->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="bg-white/20 backdrop-blur-sm p-3 rounded-full text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-4">
                            <span class="text-xs text-blue-600 font-semibold uppercase">{{ $album->title }}</span>
                            <p class="text-gray-700 font-medium text-sm mt-1 line-clamp-2">{{ $photo->caption ?? 'Dokumentasi Kegiatan' }}</p>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-20 bg-white rounded-xl shadow border border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-700 mb-1">Belum Ada Dokumentasi Galeri</h3>
            <p class="text-gray-500">Foto kegiatan dan peristiwa desa akan muncul di sini setelah diunggah oleh admin.</p>
        </div>
    @endif

    <!-- Photo Lightbox Modal -->
    <div class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center p-4 transition-all duration-300"
        x-show="lightboxOpen"
        x-transition
        style="display: none;"
        @keydown.escape.window="lightboxOpen = false">
        
        <button class="absolute top-6 right-6 text-white hover:text-gray-300 transition" @click="lightboxOpen = false">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="max-w-5xl w-full flex flex-col items-center">
            <img :src="lightboxImage" class="max-h-[80vh] object-contain rounded-lg shadow-2xl">
            <p x-text="lightboxCaption" class="text-white text-center mt-4 text-base md:text-lg font-medium max-w-2xl px-4"></p>
        </div>
    </div>
</main>
@endsection
