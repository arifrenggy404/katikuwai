<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Pengaduan;
use App\Models\LetterRequest;
use App\Models\VillageOfficial;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalNews = News::count();
        $pendingPengaduan = Pengaduan::where('status', 'Pending')->count();
        $totalPengaduan = Pengaduan::count();
        $totalLetterRequests = LetterRequest::count();
        $totalOfficials = VillageOfficial::count();

        $recentPengaduan = Pengaduan::latest()->take(5)->get();
        $recentNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalNews',
            'pendingPengaduan',
            'totalPengaduan',
            'totalLetterRequests',
            'totalOfficials',
            'recentPengaduan',
            'recentNews'
        ));
    }
}
