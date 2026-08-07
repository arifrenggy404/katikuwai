<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AdminSettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first() ?? new Setting();

        $validated = $request->validate([
            'desa_name' => 'nullable|string|max:255',
            'desa_email' => 'nullable|email|max:255',
            'desa_phone' => 'nullable|string|max:50',
            'desa_address' => 'nullable|string',
            'desa_vision' => 'nullable|string',
            'desa_mission' => 'nullable|string',
            'desa_about' => 'nullable|string',
            'desa_logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('desa_logo')) {
            if ($setting->desa_logo) {
                Storage::disk('public')->delete($setting->desa_logo);
            }
            $validated['desa_logo'] = $request->file('desa_logo')->store('settings', 'public');
        }

        $setting->fill($validated);
        $setting->save();

        // Clear view cache for setting
        Cache::forget('view_setting');

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan profil desa berhasil diperbarui!');
    }
}
