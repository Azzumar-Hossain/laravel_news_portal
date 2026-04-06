<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // Show the settings form
    public function edit()
    {
        // Fetch the first row, or create a blank one if it doesn't exist yet
        $setting = Setting::first() ?? Setting::create(['site_name' => 'My News Portal']);
        return view('admin.settings.edit', compact('setting'));
    }

    // Save the settings
    public function update(Request $request)
    {
        $setting = Setting::first();

        // Validate all fields including the new social media links
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,ico,png,svg|max:1024', 
            'top_ad_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'sidebar_ad_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'homepage_ad_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'contact_address' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_fax' => 'nullable|string|max:255',
            'contact_mobile' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|max:255',
            'app_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
        ]);

        // Assign basic info
        $setting->site_name = $request->site_name;

        // Assign Contact Info (Fixed!)
        $setting->contact_address = $request->contact_address;
        $setting->contact_phone = $request->contact_phone;
        $setting->contact_fax = $request->contact_fax;
        $setting->contact_mobile = $request->contact_mobile;
        $setting->contact_email = $request->contact_email;

        // Assign Social Links
        $setting->app_url = $request->app_url;
        $setting->facebook_url = $request->facebook_url;
        $setting->twitter_url = $request->twitter_url;

        // Handle Main Logo upload
        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('logos', 'public');
            $setting->site_logo = '/storage/' . $logoPath;
        }

        // Handle Favicon upload
        if ($request->hasFile('site_favicon')) {
            $faviconPath = $request->file('site_favicon')->store('logos', 'public');
            $setting->site_favicon = '/storage/' . $faviconPath;
        }

        // ==========================================
        // ADVERTISEMENT BANNERS LOGIC
        // ==========================================

        // 1. Handle Top Ad Banner
        if ($request->hasFile('top_ad_banner')) {
            $bannerPath = $request->file('top_ad_banner')->store('settings', 'public');
            $setting->top_ad_banner = '/storage/' . $bannerPath;
        }
        if ($request->has('top_ad_link')) {
            $setting->top_ad_link = $request->top_ad_link;
        }

        // 2. Handle Sidebar Ad Banner
        if ($request->hasFile('sidebar_ad_banner')) {
            $sidebarPath = $request->file('sidebar_ad_banner')->store('settings', 'public');
            $setting->sidebar_ad_banner = '/storage/' . $sidebarPath;
        }
        if ($request->has('sidebar_ad_link')) {
            $setting->sidebar_ad_link = $request->sidebar_ad_link;
        }

        // 3. Handle Homepage Ad Banner
        if ($request->hasFile('homepage_ad_banner')) {
            $homePath = $request->file('homepage_ad_banner')->store('settings', 'public');
            $setting->homepage_ad_banner = '/storage/' . $homePath;
        }
        if ($request->has('homepage_ad_link')) {
            $setting->homepage_ad_link = $request->homepage_ad_link;
        }

        // Save everything to the database
        $setting->save();

        return redirect()->back()->with('success', 'Site settings, social links, and Ad banners updated successfully!');
    }
}