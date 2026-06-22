@extends('layouts.app')

@section('title', 'Beranda - Website ' . ($setting?->desa_name ?? 'Desa Katiku Wai'))

@section('content')

<!-- Banner Slider Section -->
<section class="relative w-full h-[480px] overflow-hidden bg-gray-900" x-data="{
        currentSlide: 0,
        banners: {{ $banners->count() }},
        init() {
            if (this.banners > 1) {
                // Auto-slide every 5 seconds
                setInterval(() => {
                    this.goToSlide(this.currentSlide + 1);
                }, 6000);
            }
        },
        goToSlide(index) {
            // Logic for looping slides
            this.currentSlide = (index + this.banners) % this.banners;
        }
    }" x-init="init">
    @if ($banners->count() > 0)
    <div class="slider-container relative w-full h-full">
        @foreach ($banners as $index => $banner)
        <div class="slide absolute w-full h-full transition-opacity duration-700 ease-in-out"
            :class="{
                            'opacity-100 z-10': {{ $index }} === currentSlide,
                            'opacity-0 z-0': {{ $index }} !== currentSlide
                        }">

            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}"
                class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12 lg:p-16">
                <div class="max-w-7xl mx-auto">
                    <h2
                        class="text-2xl md:text-2xl lg:text-4xl font-bold text-gray-200 drop-shadow-2xl leading-tight">
                        {{ $banner->title }}
                    </h2>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if ($banners->count() > 1)
    <button @click="goToSlide(currentSlide - 1)"
        class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white p-3 md:p-4 rounded-full transition-all duration-300 backdrop-blur-sm z-20 group">
        <svg class="w-5 h-5 md:w-6 md:h-6 group-hover:scale-110 transition-transform" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button @click="goToSlide(currentSlide + 1)"
        class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white p-3 md:p-4 rounded-full transition-all duration-300 backdrop-blur-sm z-20 group">
        <svg class="w-5 h-5 md:w-6 md:h-6 group-hover:scale-110 transition-transform" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <div class="absolute bottom-4 md:bottom-6 left-1/2 -translate-x-1/2 flex gap-2 md:gap-3 z-20">
        @foreach ($banners as $index => $banner)
        <button @click="goToSlide({{ $index }})"
            :class="{
                                'bg-white w-8 md:w-10': {{ $index }} === currentSlide,
                                'bg-white/50 hover:bg-white/75': {{ $index }} !== currentSlide
                            }"
            class="w-2 h-2 md:w-3 md:h-3 rounded-full transition-all duration-300"
            aria-label="Go to slide {{ $index + 1 }}">
        </button>
        @endforeach
    </div>
    @endif
    @else
    <div class="flex flex-col items-center justify-center h-full bg-gradient-to-br from-gray-800 to-gray-900">
    </div>
    @endif
</section>

<!-- About Section -->
<section id="about" class="py-15 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Tentang {{ $setting?->desa_name ?? 'Desa Katiku Wai' }}</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">{{ $setting?->desa_about ?? 'Desa Katiku Wai adalah desa yang terletak di Kecamatan Matawai La Pawu, Kabupaten Sumba Timur, Provinsi Nusa Tenggara Timur.' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                <div class="text-blue-600 text-3xl mb-4">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Populasi</h3>
                <p class="text-gray-600">{{ $setting?->desa_population ?? '1.536 Jiwa' }} penduduk</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                <div class="text-green-600 text-3xl mb-4">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Luas Wilayah</h3>
                <p class="text-gray-600">Memiliki luas wilayah sebesar {{ $setting?->desa_area_ha ?? '15.910 Ha' }}</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                <div class="text-yellow-600 text-3xl mb-4">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Jumlah Rumah Tangga</h3>
                <p class="text-gray-600">Terdiri dari {{ $setting?->desa_families ?? '384 KK' }} di {{ $setting?->desa_name ?? 'Desa Katiku Wai' }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Vision Mission Section -->
<section class="py-4 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Visi dan Misi Desa</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Membangun desa yang sejahtera, mandiri, berbudaya dan memiliki
                daya saing</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold text-blue-600 mb-4 flex items-center">
                    <i class="fas fa-eye mr-2"></i> Visi Desa
                </h3>
                <p class="text-gray-700 leading-relaxed">
                    {{ $setting?->desa_vision ?? 'Terwujudnya Desa Katiku Wai yang Sejahtera, Berbudaya, dan Mandiri Melalui Pemanfaatan Potensi Lokal dan Infrastruktur yang Berkelanjutan.' }}
                </p>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold text-green-600 mb-4 flex items-center">
                    <i class="fas fa-bullseye mr-2"></i> Misi Desa
                </h3>
                <ul class="space-y-3 text-gray-700">
                    @if($setting && $setting->desa_mission)
                        @foreach(explode("\n", str_replace("\r", "", $setting->desa_mission)) as $misiItem)
                            @if(trim($misiItem))
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2"><i class="fas fa-check-circle"></i></span>
                                    {{ trim($misiItem) }}
                                </li>
                            @endif
                        @endforeach
                    @else
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2"><i class="fas fa-check-circle"></i></span>
                            Meningkatkan kualitas pelayanan publik dan tata kelola desa yang bersih serta transparan.
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2"><i class="fas fa-check-circle"></i></span>
                            Mengembangkan pertanian dan peternakan lokal yang berkelanjutan.
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2"><i class="fas fa-check-circle"></i></span>
                            Melestarikan nilai-nilai adat, budaya, dan kearifan lokal Sumba.
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2"><i class="fas fa-check-circle"></i></span>
                            Meningkatkan akses kesehatan dan pendidikan bagi masyarakat pedalaman.
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Lokasi {{ $setting?->desa_name ?? 'Desa Katiku Wai' }}</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Temukan lokasi pasti {{ $setting?->desa_name ?? 'Desa Katiku Wai' }} di bawah ini</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg overflow-hidden">
                <iframe
                    src="{{ $setting && $setting->desa_maps_link ? $setting->desa_maps_link : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5194.5642165465!2d104.32477346012963!3d-2.880936989917987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b031054462161%3A0xed05d357ef579aa4!2sKantor%20Desa!5e0!3m2!1sen!2sid!4v1759804386834!5m2!1sen!2sid' }}"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-2 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Galeri {{ $setting?->desa_name ?? 'Desa Katiku Wai' }}</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Dokumentasi agenda dan kegiatan {{ $setting?->desa_name ?? 'Desa Katiku Wai' }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">


            @foreach ($banners as $index => $banner)


            <div class="overflow-hidden rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title  }}" class="w-full h-48 object-cover">
            </div>

            @endforeach

        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-10 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Hubungi Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Anda memiliki pertanyaan? Hubungi kami melalui kontak di bawah
            </p>
        </div>

        <div class="max-w-2xl mx-auto bg-gray-50 p-8 rounded-lg shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Alamat</h4>
                        <p class="text-gray-600">{{ $setting?->desa_address ?? 'Jl. Lintas Sumba, Desa Katiku Wai, Kecamatan Matawai La Pawu, Kabupaten Sumba Timur, Nusa Tenggara Timur (87174)' }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-phone-alt text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Telepon</h4>
                        <p class="text-gray-600">{{ $setting?->desa_phone ?? '0821-3456-7890' }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-envelope text-purple-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Email</h4>
                        <p class="text-gray-600">{{ $setting?->desa_email ?? 'info@katikuwai.desa.id' }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="bg-orange-100 p-3 rounded-full">
                        <i class="fas fa-clock text-orange-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Jam Operasional</h4>
                        <p class="text-gray-600">Senin - Jumat: 08:00 - 16:00</p>
                    </div>
                </div>
            </div>

            <form class="space-y-4" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="nama" placeholder="Nama Lengkap" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="email" name="email" placeholder="Email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <input type="text" name="subjek" placeholder="Subjek"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <textarea rows="4" name="pesan" placeholder="Pesan Anda" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-md transition duration-300">
                    Kirim Pesan
                </button>
            </form>

        </div>
    </div>
</section>
</div>

<!-- Footer -->
@endsection
</section>