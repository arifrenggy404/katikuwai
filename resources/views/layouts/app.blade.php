<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://unpkg.com">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" media="print" onload="this.media='all'">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js" defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ ($setting && $setting->desa_logo) ? asset('storage/' . $setting->desa_logo) : asset('favicon.ico') }}" type="image/x-icon">
    <title>@yield('title', 'Website Desa')</title>
    @vite('resources/css/app.css')
</head>


@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal ⚠️',
            html: `
                    <p style="margin-bottom:10px;">Harap periksa kembali data yang Anda isi:</p>
                    <ul style="text-align:left; color:#555;">
                        {!! implode('', $errors->all('<li>• :message</li>')) !!}
                    </ul>
                `,
            confirmButtonColor: '#f59e0b',
            confirmButtonText: 'Perbaiki Sekarang'
        });
    });
</script>
@endif

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Pesan Berhasil Dikirim 🎉',
            text: @json(session('success')),
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Baik, Terima Kasih'
        });
    });
</script>
@endif

@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan 😞',
            text: @json(session('error')),
            confirmButtonColor: '#d33',
            confirmButtonText: 'Coba Lagi'
        });
    });
</script>
@endif


<body class="bg-gray-50">

    {{-- Header --}}
    @include('partials.header')

    {{-- Konten halaman --}}
    <div class="w-full min-h-screen">
        @yield('content')
    </div>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- =========================
         SWEET ALERT SESSION
    ========================== --}}



</body>

</html>