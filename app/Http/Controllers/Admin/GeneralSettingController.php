<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $setting = GeneralSetting::first();
        $title = 'General Settings';
        return view('admin.settings.general', compact('setting', 'title'));
    }

    public function update(Request $request)
    {
        $setting = GeneralSetting::first();

        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'tagline' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'default_theme' => 'required|in:light,dark',
            'maintenance_mode' => 'nullable',
            'maintenance_message' => 'nullable|string',
        ]);

        $data['maintenance_mode'] = $request->has('maintenance_mode');

        $setting->update($data);

        return redirect()->back()->with('success', 'General settings updated successfully.');
    }
}

