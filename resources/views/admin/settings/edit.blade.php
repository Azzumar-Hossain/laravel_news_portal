<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Site Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Basic Information</h3>

                        <div class="mb-4">
                            <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                            <input type="text" name="site_name" id="site_name" value="{{ $setting->site_name }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="site_logo" class="block text-sm font-medium text-gray-700">Site Logo</label>
                            @if ($setting->site_logo)
                                <div class="mt-2 mb-3 bg-gray-50 p-3 rounded border inline-block">
                                    <img src="{{ $setting->site_logo }}" alt="Current Logo" class="h-12 object-contain">
                                </div>
                            @endif
                            <input type="file" name="site_logo" id="site_logo" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="mb-4">
                            <label for="site_favicon" class="block text-sm font-medium text-gray-700">Site Favicon
                                (Browser Tab Icon)</label>
                            @if ($setting->site_favicon)
                                <div class="mt-2 mb-3 bg-gray-50 p-3 rounded border inline-block">
                                    <img src="{{ $setting->site_favicon }}" alt="Current Favicon"
                                        class="h-8 object-contain">
                                </div>
                            @endif
                            <input type="file" name="site_favicon" id="site_favicon" accept="image/*,.ico"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <small class="text-gray-500">Recommended size: 32x32 pixels (PNG or ICO format).</small>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Advertisement Banners</h3>

                        <div class="bg-gray-50 p-4 rounded-md mb-6 border">
                            <h4 class="font-semibold text-gray-700 mb-2">Top Header Ad (1200x150)</h4>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-600 mb-1">Banner Image</label>
                                @if ($setting->top_ad_banner)
                                    <img src="{{ $setting->top_ad_banner }}"
                                        class="h-16 object-cover rounded shadow-sm mb-2">
                                @endif
                                <input type="file" name="top_ad_banner" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Ad Link (URL)</label>
                                <input type="url" name="top_ad_link" value="{{ $setting->top_ad_link }}"
                                    placeholder="https://example.com"
                                    class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-md mb-6 border">
                            <h4 class="font-semibold text-gray-700 mb-2">Sidebar Ad (300x600)</h4>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-600 mb-1">Banner Image</label>
                                @if ($setting->sidebar_ad_banner)
                                    <img src="{{ $setting->sidebar_ad_banner }}"
                                        class="h-32 object-contain rounded shadow-sm mb-2 bg-white">
                                @endif
                                <input type="file" name="sidebar_ad_banner" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Ad Link (URL)</label>
                                <input type="url" name="sidebar_ad_link" value="{{ $setting->sidebar_ad_link }}"
                                    placeholder="https://example.com"
                                    class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-md mb-6 border">
                            <h4 class="font-semibold text-gray-700 mb-2">Homepage Middle Ad (300x250)</h4>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-600 mb-1">Banner Image</label>
                                @if ($setting->homepage_ad_banner)
                                    <img src="{{ $setting->homepage_ad_banner }}"
                                        class="h-24 object-cover rounded shadow-sm mb-2">
                                @endif
                                <input type="file" name="homepage_ad_banner" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Ad Link (URL)</label>
                                <input type="url" name="homepage_ad_link" value="{{ $setting->homepage_ad_link }}"
                                    placeholder="https://example.com"
                                    class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-5 border-t">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Contact & Footer Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Office Address</label>
                                <input type="text" name="contact_address"
                                    value="{{ old('contact_address', $setting->contact_address) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="e.g. বেলেপুকুর, চাঁপাইনবাবগঞ্জ।">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Phone Number</label>
                                <input type="text" name="contact_phone"
                                    value="{{ old('contact_phone', $setting->contact_phone) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="e.g. +02588892975">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Fax Number</label>
                                <input type="text" name="contact_fax"
                                    value="{{ old('contact_fax', $setting->contact_fax) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="e.g. +02588892601">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Mobile Numbers</label>
                                <input type="text" name="contact_mobile"
                                    value="{{ old('contact_mobile', $setting->contact_mobile) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="e.g. 01713248558, 01713248560">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block font-medium text-sm text-gray-700">Email Addresses</label>
                                <input type="text" name="contact_email"
                                    value="{{ old('contact_email', $setting->contact_email) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="e.g. sm@radiomahananda.fm, news@radiomahananda.fm">
                            </div>

                        </div>
                    </div>

                    <div class="mt-8 pt-5 border-t">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Social Media & App Links</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Mobile App URL (Play Store)</label>
                                <input type="url" name="app_url"
                                    value="{{ old('app_url', $setting->app_url) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="https://play.google.com/store/apps/details?id=...">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Facebook URL</label>
                                <input type="url" name="facebook_url"
                                    value="{{ old('facebook_url', $setting->facebook_url) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="https://facebook.com/yourpage">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Twitter (X) URL</label>
                                <input type="url" name="twitter_url"
                                    value="{{ old('twitter_url', $setting->twitter_url) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="https://twitter.com/yourhandle">
                            </div>

                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-medium">
                            Save Settings
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>