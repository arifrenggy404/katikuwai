@extends('layouts.app')

@section('title', 'Tanya Jawab (FAQ) - ' . ($setting?->desa_name ?? 'Desa Katiku Wai'))

@section('content')
<!-- Hero Section -->
<div class="hero-section h-64 md:h-30 flex items-center justify-center bg-blue-900 mt-1">
    <div class="text-center px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Tanya Jawab (FAQ)</h2>
        <p class="text-l text-white max-w-xl mx-auto">Temukan jawaban atas pertanyaan-pertanyaan umum seputar layanan dan informasi di {{ $setting?->desa_name ?? 'Desa Katiku Wai' }}</p>
    </div>
</div>

<!-- FAQ Section -->
<div class="container mx-auto px-4 py-12 max-w-4xl">
    <div class="bg-white rounded-xl shadow-lg border border-blue-100 overflow-hidden p-6 md:p-10">
        <h2 class="text-2xl font-bold text-blue-900 mb-8 text-center relative pb-4">
            Pertanyaan Umum Pelayanan
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-600 rounded-full"></span>
        </h2>

        @if($faqs->count() > 0)
            <div class="space-y-4" x-data="{ active: null }">
                @foreach($faqs as $index => $faq)
                    <div class="border border-gray-200 rounded-lg overflow-hidden transition-all duration-300"
                        :class="active === {{ $index }} ? 'border-blue-500 ring-1 ring-blue-500' : 'hover:border-blue-300'">
                        
                        <!-- Question Header -->
                        <button class="w-full flex justify-between items-center px-6 py-4 bg-gray-50 text-left focus:outline-none transition-colors"
                            :class="active === {{ $index }} ? 'bg-blue-50' : 'bg-gray-50'"
                            @click="active = (active === {{ $index }} ? null : {{ $index }})">
                            <span class="font-semibold text-gray-800 text-base md:text-lg flex items-start">
                                <span class="text-blue-600 font-bold mr-3">Q:</span>
                                <span>{{ $faq->question }}</span>
                            </span>
                            <span class="text-blue-900 transition-transform duration-300" 
                                :class="active === {{ $index }} ? 'rotate-180' : ''">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>

                        <!-- Answer Body -->
                        <div class="transition-all duration-500 ease-in-out"
                            x-show="active === {{ $index }}"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 max-h-0"
                            x-transition:enter-end="opacity-100 max-h-screen"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 max-h-screen"
                            x-transition:leave-end="opacity-0 max-h-0"
                            style="display: none;">
                            <div class="px-6 py-4 bg-white border-t border-gray-100 text-gray-700 leading-relaxed text-sm md:text-base flex items-start">
                                <span class="text-green-600 font-bold mr-3 flex-shrink-0">A:</span>
                                <div>{!! nl2br(e($faq->answer)) !!}</div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-gray-600">Belum ada pertanyaan umum yang diisi.</p>
            </div>
        @endif
    </div>

    <!-- Contact CTA -->
    <div class="mt-8 bg-blue-50 border border-blue-100 rounded-xl p-6 text-center shadow-sm">
        <h3 class="text-lg font-semibold text-blue-900 mb-2">Masih Memiliki Pertanyaan Lain?</h3>
        <p class="text-gray-600 mb-4">Jika Anda tidak dapat menemukan jawaban atas pertanyaan Anda, silakan hubungi kami langsung.</p>
        <div class="flex justify-center space-x-4">
            <a href="/#contact" class="px-6 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition text-sm font-semibold">
                Hubungi Kami
            </a>
            <a href="/pengaduan" class="px-6 py-2 border border-blue-900 text-blue-900 rounded-lg hover:bg-blue-50 transition text-sm font-semibold">
                Ajukan Pengaduan
            </a>
        </div>
    </div>
</div>
@endsection
