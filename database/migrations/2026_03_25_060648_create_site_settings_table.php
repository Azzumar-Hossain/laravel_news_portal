<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            
            // Basic Site Info
            $table->string('site_name')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();

            // Top Header Advertisement
            $table->string('top_ad_banner')->nullable();
            $table->string('top_ad_link')->nullable();
            
            // Sidebar Advertisement
            $table->string('sidebar_ad_banner')->nullable();
            $table->string('sidebar_ad_link')->nullable();
            
            // Homepage Advertisement
            $table->string('homepage_ad_banner')->nullable();
            $table->string('homepage_ad_link')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
