<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use App\Models\Banner;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBannerController extends Controller
{
    public function index()
    {
        $homeBanners = HomeBanner::orderBy('order', 'asc')->get();
        $newsBanners = Banner::with('news')->latest()->get();
        $allNews = News::latest()->get();

        return view('admin.banners.index', compact('homeBanners', 'newsBanners', 'allNews'));
    }

    // Home Banner Store
    public function storeHomeBanner(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:5120',
            'order' => 'required|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('banners', 'public');
        }

        HomeBanner::create($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Banner utama berhasil ditambahkan!');
    }

    // Home Banner Destroy
    public function destroyHomeBanner(HomeBanner $homeBanner)
    {
        if ($homeBanner->image && Storage::disk('public')->exists($homeBanner->image)) {
            Storage::disk('public')->delete($homeBanner->image);
        }
        $homeBanner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner utama berhasil dihapus!');
    }

    // News Banner Store
    public function storeNewsBanner(Request $request)
    {
        $request->validate([
            'news_id' => 'required|exists:news,id',
        ]);

        Banner::create(['news_id' => $request->news_id]);

        return redirect()->route('admin.banners.index')->with('success', 'Berita berhasil dijadikan Banner Berita!');
    }

    // News Banner Destroy
    public function destroyNewsBanner(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner berita berhasil dihapus!');
    }
}
