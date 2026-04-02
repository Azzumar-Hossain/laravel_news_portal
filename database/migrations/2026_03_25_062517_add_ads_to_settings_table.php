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
        Schema::table('settings', function (Blueprint $table) {
            // Add the advertisement columns to your existing settings table
            $table->string('top_ad_banner')->nullable();
            $table->string('top_ad_link')->nullable();
            
            $table->string('sidebar_ad_banner')->nullable();
            $table->string('sidebar_ad_link')->nullable();
            
            $table->string('homepage_ad_banner')->nullable();
            $table->string('homepage_ad_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'top_ad_banner', 'top_ad_link', 
                'sidebar_ad_banner', 'sidebar_ad_link', 
                'homepage_ad_banner', 'homepage_ad_link'
            ]);
        });
    }
};
