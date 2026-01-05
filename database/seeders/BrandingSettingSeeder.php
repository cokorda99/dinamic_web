<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BrandingSetting;

class BrandingSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        BrandingSetting::create([
            // Logo
            'logo' => null,
            'logo_dark' => null,
            'logo_light' => null,
            'favicon' => null,

            // Colors
            'primary_color' => '#f3413b',
            'secondary_color' => '#7fd324',
            'accent_color' => '#ffcc00',
            'background_light' => '#ffffff',
            'background_dark' => '#202020',
            'text_primary' => '#202020',
            'text_secondary' => '#626262',

            // Typography
            'font_heading' => 'Poppins',
            'font_body' => 'Inter',
            'font_base_size' => 16,
            'line_height' => 1.6,

            // UI
            'border_radius' => 12,
            'enable_shadow' => true,

            // Theme
            'default_theme' => 'light',
            'enable_theme_toggle' => true,

            // Custom
            'custom_css' => null,
            'custom_js' => null,
        ]);
    }
}
