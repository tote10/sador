<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    
    public function edit()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.edit', compact('settings'));
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_phone' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'whatsapp_number' => 'required|string|max:255',
            'working_hours' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            // Homepage statistic counters
            'years_experience' => 'required|integer|min:0',
            'projects_completed' => 'required|integer|min:0',
            'happy_clients' => 'required|integer|min:0',
            'professional_staff' => 'required|integer|min:0',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Bust the cached settings shared with every view (see AppServiceProvider).
        Cache::forget('site_settings');

        return back()->with('success', 'Settings updated successfully.');
    }
}
