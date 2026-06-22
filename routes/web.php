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

