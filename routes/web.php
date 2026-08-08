<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DokumenDesaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PotensiDesaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LetterRequestController;
use App\Models\DokumenDesa;
use Illuminate\Support\Facades\Route;

// menu nav

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/layanan', [DokumenDesaController::class, 'index'])->name('pages.layanan.layanan');
// Route untuk cek status pengaduan
Route::get('/check-status', [PengaduanController::class, 'checkStatus'])->name('pengaduan.check-status');

Route::get('/pengaduan', function () {
    return view('pages.pengaduan.pengaduan');
})->name('pengaduan');

Route::get('/profildesa', [PotensiDesaController::class, 'index'])->name('profildesa');
Route::get('/kontak', function () {
    return view('pages.kontak');
});

// berita
Route::get('/berita', [NewsController::class, 'index'])->name('Berita');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

// pengaduan
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.create');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

// Galeri Foto
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

// Pengajuan Surat Online
Route::get('/layanan/pengajuan-surat', [LetterRequestController::class, 'create'])->name('letter-requests.create');
Route::post('/layanan/pengajuan-surat', [LetterRequestController::class, 'store'])->name('letter-requests.store');
Route::get('/layanan/cek-surat', [LetterRequestController::class, 'checkStatus'])->name('letter-requests.check');

// Custom Ultra-Fast Admin Panel Routes (Pure PHP / Blade)
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminPengaduanController;
use App\Http\Controllers\Admin\AdminOfficialController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminDokumenController;
use App\Http\Controllers\Admin\AdminLetterRequestController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminPotensiController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminBudgetController;
use App\Http\Controllers\Admin\AdminDemographicController;

// Named route 'login' required by Laravel Auth Middleware for unauthenticated redirects
Route::get('/login', function() {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

        // News CRUD
        Route::resource('news', AdminNewsController::class);

        // Kategori Berita CRUD
        Route::resource('categories', AdminCategoryController::class);

        // Banners Management
        Route::get('/banners', [AdminBannerController::class, 'index'])->name('banners.index');
        Route::post('/banners/home', [AdminBannerController::class, 'storeHomeBanner'])->name('banners.home.store');
        Route::delete('/banners/home/{homeBanner}', [AdminBannerController::class, 'destroyHomeBanner'])->name('banners.home.destroy');
        Route::post('/banners/news', [AdminBannerController::class, 'storeNewsBanner'])->name('banners.news.store');
        Route::delete('/banners/news/{banner}', [AdminBannerController::class, 'destroyNewsBanner'])->name('banners.news.destroy');

        // Dana Desa / APBDes CRUD
        Route::resource('budgets', AdminBudgetController::class);

        // Data Statistik / Demografi CRUD
        Route::resource('demographics', AdminDemographicController::class);

        // Gallery Albums & Photos CRUD
        Route::resource('gallery', AdminGalleryController::class);
        Route::post('/gallery/{gallery}/photos', [AdminGalleryController::class, 'storePhoto'])->name('gallery.photos.store');
        Route::delete('/gallery/photos/{photo}', [AdminGalleryController::class, 'destroyPhoto'])->name('gallery.photos.destroy');

        // Perangkat Desa CRUD
        Route::resource('officials', AdminOfficialController::class);

        // Potensi Desa CRUD
        Route::resource('potensi', AdminPotensiController::class);

        // Dokumen Desa CRUD
        Route::resource('dokumen', AdminDokumenController::class);

        // Agenda Events CRUD
        Route::resource('events', AdminEventController::class);

        // Letter Requests Management
        Route::get('/letters', [AdminLetterRequestController::class, 'index'])->name('letters.index');
        Route::get('/letters/{letter}', [AdminLetterRequestController::class, 'show'])->name('letters.show');
        Route::patch('/letters/{letter}/status', [AdminLetterRequestController::class, 'updateStatus'])->name('letters.updateStatus');
        Route::delete('/letters/{letter}', [AdminLetterRequestController::class, 'destroy'])->name('letters.destroy');

        // Pengaduan Management
        Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{pengaduan}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
        Route::patch('/pengaduan/{pengaduan}/status', [AdminPengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
        Route::delete('/pengaduan/{pengaduan}', [AdminPengaduanController::class, 'destroy'])->name('pengaduan.destroy');

        // Settings Management
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});

