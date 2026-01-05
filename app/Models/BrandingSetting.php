<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandingSetting extends Model
{
    use HasFactory;
    protected $table = 'branding_settings';

    protected $fillable = [
        'logo',
        'logo_dark',
        'logo_light',
        'favicon',
        'primary_color',
        'secondary_color',
        'accent_color',
        'background_light',
        'background_dark',
        'text_primary',
        'text_secondary',
        'font_heading',
        'font_body',
        'font_base_size',
        'line_height',
        'border_radius',
        'enable_shadow',
        'default_theme',
        'enable_theme_toggle',
        'custom_css',
        'custom_js',
    ];
}
