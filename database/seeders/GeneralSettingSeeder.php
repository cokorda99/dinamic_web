<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GeneralSetting;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        GeneralSetting::create([
            'site_name' => 'My Website',
            'tagline' => 'We Create a Professional',
            'email' => 'admin@example.com',
            'phone' => '+62 812 3456 7890',
            'address' => 'Indonesia',
            'default_theme' => 'light',
            'maintenance_mode' => false,
        ]);
    }
}
