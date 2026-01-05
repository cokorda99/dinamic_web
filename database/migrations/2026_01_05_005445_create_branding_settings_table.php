<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branding_settings', function (Blueprint $table) {
            $table->id();
            // Logo & Icon
            $table->string('logo')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('logo_light')->nullable();
            $table->string('favicon')->nullable();

            // Color Palette
            $table->string('primary_color')->default('#f3413b');
            $table->string('secondary_color')->default('#7fd324');
            $table->string('accent_color')->nullable();
            $table->string('background_light')->default('#ffffff');
            $table->string('background_dark')->default('#202020');
            $table->string('text_primary')->default('#202020');
            $table->string('text_secondary')->default('#626262');

            // Typography
            $table->string('font_heading')->default('Poppins');
            $table->string('font_body')->default('Inter');
            $table->integer('font_base_size')->default(16);
            $table->float('line_height')->default(1.6);

            // UI Style
            $table->integer('border_radius')->default(12);
            $table->boolean('enable_shadow')->default(true);

            // Theme
            $table->enum('default_theme', ['light', 'dark', 'auto'])->default('light');
            $table->boolean('enable_theme_toggle')->default(true);

            // Custom Style
            $table->longText('custom_css')->nullable();
            $table->longText('custom_js')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branding_settings');
    }
};
