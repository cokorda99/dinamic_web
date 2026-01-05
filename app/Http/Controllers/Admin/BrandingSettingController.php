<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\BrandingSetting;
use Illuminate\Support\Facades\Storage;

class BrandingSettingController extends Controller
{
    //
    public function index()
    {
        $setting = GeneralSetting::first();
        $branding = BrandingSetting::first();
        $title = 'Branding Settings';
        return view('admin.settings.branding', compact('setting', 'branding', 'title'));
    }

    public function update(Request $request)
    {
        $branding = BrandingSetting::first();

        $data = $request->validate([
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string',
            'accent_color' => 'nullable|string',
            'background_light' => 'required|string',
            'background_dark' => 'required|string',
            'text_primary' => 'required|string',
            'text_secondary' => 'required|string',

            'font_heading' => 'required|string',
            'font_body' => 'required|string',
            'font_base_size' => 'required|integer',
            'line_height' => 'required|numeric',

            'border_radius' => 'required|integer',
            'enable_shadow' => 'nullable',
            'default_theme' => 'required|in:light,dark,auto',
            'enable_theme_toggle' => 'nullable',

            'custom_css' => 'nullable|string',
            'custom_js' => 'nullable|string',

            // images
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'logo_dark' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'logo_light' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:1024',
        ]);

        /* Checkbox */
        $data['enable_shadow'] = $request->has('enable_shadow');
        $data['enable_theme_toggle'] = $request->has('enable_theme_toggle');

        /* Upload Handler */
        foreach (['logo', 'logo_dark', 'logo_light', 'favicon'] as $field) {
            if ($request->hasFile($field)) {
                if ($branding->$field && Storage::disk('public')->exists($branding->$field)) {
                    Storage::disk('public')->delete($branding->$field);
                }

                $data[$field] = $request->file($field)
                    ->store('branding', 'public');
            }
        }

        $branding->update($data);

        return back()->with('success', 'Branding settings updated successfully');
    }
}
