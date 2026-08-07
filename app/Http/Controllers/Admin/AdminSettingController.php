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
            'desa_maps_link' => 'nullable|string',
            'desa_vision' => 'nullable|string',
            'desa_mission' => 'nullable|string',
            'desa_about' => 'nullable|string',
            'desa_history' => 'nullable|string',
            'desa_origin' => 'nullable|string',
            'desa_area' => 'nullable|string|max:100',
            'desa_area_ha' => 'nullable|string|max:100',
            'desa_population' => 'nullable|string|max:100',
            'desa_families' => 'nullable|string|max:100',
            'desa_rt' => 'nullable|string|max:50',
            'desa_dusun' => 'nullable|string|max:50',
            'bound_north' => 'nullable|string|max:255',
            'bound_east' => 'nullable|string|max:255',
            'bound_south' => 'nullable|string|max:255',
            'bound_west' => 'nullable|string|max:255',
            'desa_logo' => 'nullable|image|max:2048',
            'desa_history_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('desa_logo')) {
            if ($setting->desa_logo) {
                Storage::disk('public')->delete($setting->desa_logo);
            }
            $validated['desa_logo'] = $request->file('desa_logo')->store('settings', 'public');
        }

        if ($request->hasFile('desa_history_image')) {
            if ($setting->desa_history_image) {
                Storage::disk('public')->delete($setting->desa_history_image);
            }
            $validated['desa_history_image'] = $request->file('desa_history_image')->store('settings', 'public');
        }

        $setting->fill($validated);
        $setting->save();

        // Clear view cache for setting across the entire application
        Cache::forget('view_setting');
        Cache::flush();

        return redirect()->route('admin.settings.index')->with('success', 'Seluruh informasi profil, footer, dan peta desa berhasil diperbarui!');
    }
}
