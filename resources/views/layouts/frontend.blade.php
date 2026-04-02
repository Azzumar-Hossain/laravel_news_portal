<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $siteSetting->site_name ?? 'Global Times - Clone' }}</title>
    @if (isset($siteSetting) && $siteSetting->site_favicon)
        <link rel="icon" href="{{ $siteSetting->site_favicon }}" type="image/x-icon">
    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        /* ==========================================
           Desktop Hover Dropdown Menu
           ========================================== */
        @media all and (min-width: 992px) {
            .navbar .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0; /* Prevents the menu from closing when moving mouse down */
            }
            
            /* Optional: Adds a smooth little fade-in animation */
            .navbar .nav-item.dropdown:hover .dropdown-menu {
                animation: fadeDropdown 0.2s ease-in-out;
            }
            
            @keyframes fadeDropdown {
                0% { opacity: 0; transform: translateY(5px); }
                100% { opacity: 1; transform: translateY(0); }
            }
        }
    </style>
</head>

<body>
    <div class="py-2 bg-white d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center text-md-start fw-medium" style="font-size: 0.9rem; font-family: 'Tiro Bangla', Georgia, serif; color: #333;">
                    
                    @php
                        // 1. Translation Arrays
                        $engDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                        $bngDays = ['রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার'];
                        
                        $engMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                        $bngMonths = ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
                        
                        $engNum = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                        $bngNum = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

                        // 2. Automatically generate today's Gregorian Date in Bengali
                        $currentDayName = str_replace($engDays, $bngDays, date('l'));
                        $currentMonth   = str_replace($engMonths, $bngMonths, date('F'));
                        $currentDay     = str_replace($engNum, $bngNum, date('d'));
                        $currentYear    = str_replace($engNum, $bngNum, date('Y'));
                        
                        $gregorianDate  = "{$currentDayName}, {$currentDay} {$currentMonth}, {$currentYear} খ্রিস্টাব্দ";
                        
                        // 3. Placeholders for Bangla and Hijri (Best managed via Admin Panel)
                        $banglaDate = $siteSetting->bangla_date ?? "১৭ চৈত্র, ১৪৩২ বঙ্গাব্দ"; 
                        $hijriDate  = $siteSetting->hijri_date ?? "১১ শাওয়াল, ১৪৪৭ হিজরি";
                    @endphp

                    <i class="fa-regular fa-calendar me-1 text-danger"></i> 
                    {{ $gregorianDate }}, {{ $banglaDate }}, {{ $hijriDate }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="container py-3 bg-white">
        <div class="row align-items-center">

            <div class="col-lg-3 col-md-2 d-none d-md-flex gap-3">
                <a href="#" class="text-dark fs-5 text-decoration-none hover-red"><i
                        class="fa-solid fa-mobile-screen"></i></a>
                <a href="#" class="text-dark fs-5 text-decoration-none hover-red"><i
                        class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="text-dark fs-5 text-decoration-none hover-red"><i
                        class="fa-brands fa-twitter"></i></a>
            </div>

            <div class="col-lg-6 col-md-6 d-flex flex-column flex-lg-row align-items-center justify-content-center gap-4 mb-3 mb-md-0">

                <a href="{{ route('home') }}" class="text-decoration-none flex-shrink-0">
                    @if (isset($siteSetting) && $siteSetting->site_logo)
                        <img src="{{ $siteSetting->site_logo }}" alt="{{ $siteSetting->site_name }}"
                            style="max-height: 120px; object-fit: contain;">
                    @else
                        <h1 class="text-danger m-0 fw-bold"
                            style="font-family: Georgia, serif; letter-spacing: 1px; text-transform: uppercase;">
                            {{ $siteSetting->site_name ?? 'GLOBAL TIMES' }}
                        </h1>
                    @endif
                </a>

                <div id="live-radio-player" data-turbo-permanent class="flex-shrink-0" style="width: 750px; transform: scale(0.65); transform-origin: center; margin-top: -55px; margin-bottom: -55px;">
                    <div class="cstrEmbed" data-type="newStreamPlayer" data-publicToken="2141f1d7-a82d-4800-af1f-cfd14aac034b" data-theme="light" data-color="6C2BDD" data-channelId="" data-rendered="false">
                        <a href="https://www.caster.fm" style="display: none;">Shoutcast Hosting</a> 
                        <a href="https://www.caster.fm" style="display: none;">Stream Hosting</a> 
                        <a href="https://www.caster.fm" style="display: none;">Radio Server Hosting</a>
                    </div>
                    <script src="//cdn.cloud.caster.fm/widgets/embed.js"></script>
                </div>

            </div>

            <div class="col-lg-3 col-md-4 d-flex justify-content-md-end justify-content-center">
                <form action="{{ route('search') }}" method="GET" class="d-flex w-100" style="max-width: 250px;">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control rounded-0 border-danger border-end-0"
                            placeholder="Search news..." value="{{ request('q') }}" required style="box-shadow: none;">
                        <button class="btn btn-danger rounded-0 px-3" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-top border-bottom shadow-sm sticky-top z-3">
        <div class="container">

            <button class="navbar-toggler rounded-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-bold"
                    style="font-family: Arial, sans-serif; font-size: 0.95rem;">

                    <li class="nav-item">
                        <a class="nav-link text-dark hover-red px-3" href="{{ route('home') }}">নীড়</a>
                    </li>

                    @isset($navCategories)
                        @foreach ($navCategories as $category)
                            @if ($category->subcategories->count() > 0)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark hover-red px-3" href="#"
                                        id="navbarDropdown{{ $category->id }}" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $category->name }}
                                    </a>
                                    <ul class="dropdown-menu border-0 shadow-sm rounded-0 border-top border-danger border-3"
                                        aria-labelledby="navbarDropdown{{ $category->id }}">
                                        <li>
                                            <a class="dropdown-item fw-bold py-2"
                                                href="{{ route('category', $category->name) }}">
                                                All {{ $category->name }}
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        @foreach ($category->subcategories as $sub)
                                            <li>
                                                <a class="dropdown-item py-2"
                                                    href="{{ route('category', $sub->name) }}">{{ $sub->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-dark hover-red px-3"
                                        href="{{ route('category', $category->name) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endisset

                </ul>
            </div>

        </div>
    </nav>

    <main>
     
     @yield('content')
    </main>

    <footer class="bg-dark text-white pt-5 mt-5">
        <div class="container pb-4">
            <div class="row">

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 text-center text-lg-start">
                    <div class="bg-white d-inline-block p-2 rounded">
                        <a href="{{ route('home') }}">
                            @if (isset($siteSetting) && $siteSetting->site_logo)
                                <img src="{{ $siteSetting->site_logo }}" alt="{{ $siteSetting->site_name }}"
                                    style="max-height: 80px;">
                            @else
                                <h3 class="text-danger m-0 fw-bold px-2" style="font-family: Georgia, serif;">
                                    {{ $siteSetting->site_name ?? 'MAHANANDA' }}</h3>
                            @endif
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-light">যোগাযোগ</h6>
                    <p class="mb-1 small text-light opacity-75">{{ $siteSetting->site_name ?? 'রেডিও মহানন্দা' }}</p>
                    <p class="mb-1 small text-light opacity-75">{{ $siteSetting->contact_address ?? 'বেলেপুকুর, চাঁপাইনবাবগঞ্জ।' }}</p>
                    <p class="mb-1 small text-light opacity-75"><strong>ফোনঃ</strong> {{ $siteSetting->contact_phone ?? '+02588892975' }}</p>
                    <p class="mb-0 small text-light opacity-75"><strong>ফ্যাক্সঃ</strong> {{ $siteSetting->contact_fax ?? '+02588892601' }}</p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-light">মোবাইলঃ</h6>
                    <p class="mb-1 small text-light opacity-75">{{ $siteSetting->contact_mobile ?? '01713248558, 01713248560' }}</p>
                    <p class="mb-1 small text-light opacity-75 mt-2"><strong>ই-মেইলঃ</strong></p>
                    <p class="mb-0 small text-light opacity-75">{{ $siteSetting->contact_email ?? 'sm@radiomahananda.fm' }}</p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-light">মোবাইল অ্যাপ</h6>
                    <p class="mb-3 small text-light opacity-75">ডাউনলোড করুন</p>
                    <a href="#">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                            alt="Get it on Google Play" style="width: 140px;">
                    </a>
                </div>
            </div>

            <div
                class="d-flex flex-column flex-md-row justify-content-md-end align-items-center mt-4 border-top border-secondary pt-4 gap-3">
                <span class="small fw-bold text-light opacity-75">আমাদের সঙ্গে থাকুন</span>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white fs-5 hover-red"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="text-white fs-5 hover-red"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="text-white fs-5 hover-red"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="py-3 text-center" style="background-color: #f3efe6; color: #111;">
            <span class="fw-medium" style="font-size: 0.95rem;">
                &copy; All Copyright {{ date('Y') }} by {{ $siteSetting->site_name ?? 'Radio Mahananda' }}.
                Developed by <a href="https://proyasit.com" target="_blank" class="text-decoration-none"
                    style="color: #c44062; font-weight: 600;">Proyas IT</a>
            </span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@hotwired/turbo@7.3.0/dist/turbo.es2017-umd.js"></script>

</body>

</html>