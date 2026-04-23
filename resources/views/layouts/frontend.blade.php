<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $siteSetting->site_name ?? 'Global Times - Clone' }}</title>
    @yield('meta_tags')
    @if (isset($siteSetting) && $siteSetting->site_favicon)
        <link rel="icon" href="{{ $siteSetting->site_favicon }}" type="image/x-icon">
    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Import Kalpurush Font */
        @import url('https://fonts.maateen.me/kalpurush/font.css');

        body {
            font-family: 'Kalpurush', Arial, sans-serif;
        }

        /* Desktop Hover Dropdown Menu */
        @media all and (min-width: 992px) {
            .navbar .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0;
                animation: fadeDropdown 0.2s ease-in-out;
            }

            /* This creates an invisible bridge so the mouse never falls into a gap */
            .navbar .dropdown-menu::before {
                content: "";
                position: absolute;
                top: -10px;
                left: 0;
                right: 0;
                height: 10px;
                background: transparent;
            }

            @keyframes fadeDropdown {
                0% {
                    opacity: 0;
                    transform: translateY(5px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        }

        /* ==========================================
            PRINT VIEW STYLES
            ========================================== */
        @media print {
            /* 1. Forcefully erase the ticker, nav, and any print-hidden items */
            .d-print-none, 
            .ticker-wrapper, 
            #print-news-ticker,
            nav {
                display: none !important;
                opacity: 0 !important;
                visibility: hidden !important;
                height: 0 !important;
            }

            /* 2. Hide the text title in the header */
            #print-title {
                display: none !important;
            }

            /* 3. Make the Logo HUGE */
            #print-logo {
                display: block !important;
                height: 150px !important; /* THIS IS THE MAGIC LINE! It overrides the 85px */
                max-height: none !important; /* Removes any maximum limits */
                width: auto !important;
                margin: 0 0 20px 0 !important;
            }
        }

        /* ==========================================
             Responsive Header & Player Sizes
             ========================================== */
        .header-logo {
            height: auto !important;
            width: 85px !important; /* Super small for tiny mobile screens to stop overlapping */
            max-width: 100% !important;
            object-fit: contain;
            display: block !important;
            transition: all 0.3s ease;
        }

        @media (min-width: 576px) {
            .header-logo {
                width: 120px !important; /* Size for Landscape Mobile */
            }
        }

        @media (min-width: 768px) {
            .header-logo {
                width: 180px !important; /* Size for Tablet */
            }
        }

        @media (min-width: 992px) {
            .header-logo {
                width: 220px !important; /* Your perfect Desktop size */
            }
        }

        .play-btn {
            width: 36px;
            height: 36px; /* Smaller button for mobile */
            transition: all 0.3s ease;
        }

        @media (min-width: 768px) {
            .play-btn {
                width: 40px; /* Reduced slightly to give logo more space */
                height: 40px; 
            }
        }

        .radio-text {
            font-size: 0.8rem; /* Smaller text for mobile */
        }

        @media (min-width: 768px) {
            .radio-text {
                font-size: 0.9rem; /* Reduced slightly to compact the player */
            }
        }

        /* Custom Radio Player CSS */
        .radio-player-card {
            transition: all 0.3s ease;
        }

        .radio-player-card:hover {
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .live-dot {
            width: 6px;
            height: 6px;
            background-color: #fff;
            border-radius: 50%;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.2; }
            100% { opacity: 1; }
        }

        .sound-bars {
            height: 15px;
            gap: 3px;
        }

        .sound-bars .bar {
            width: 4px;
            background-color: #dc3545;
            border-radius: 2px;
            height: 3px;
            transition: height 0.2s ease;
        }

        .sound-bars.playing .bar {
            animation: bounce 1s infinite alternate;
        }

        .sound-bars.playing .bar:nth-child(1) { animation-delay: 0.1s; }
        .sound-bars.playing .bar:nth-child(2) { animation-delay: 0.3s; }
        .sound-bars.playing .bar:nth-child(3) { animation-delay: 0.0s; }
        .sound-bars.playing .bar:nth-child(4) { animation-delay: 0.4s; }
        .sound-bars.playing .bar:nth-child(5) { animation-delay: 0.2s; }

        @keyframes bounce {
            0% { height: 3px; }
            100% { height: 15px; }
        }

        #volume-slider::-webkit-slider-thumb {
            background: #dc3545;
        }

        #volume-slider::-moz-range-thumb {
            background: #dc3545;
        }
        
        .ticker-wrapper {
            background-color: #f8f9fa;
        }

        .ticker-content {
            display: inline-block;
            white-space: nowrap;
            padding-left: 100%;
            animation: marquee 60s linear infinite;
        }

        .ticker-wrapper:hover .ticker-content {
            animation-play-state: paused;
        }

        @keyframes marquee {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }

        /* ==========================================
           Menu Font Size Adjustment for Kalpurush
           ========================================== */
        .navbar-nav .nav-link {
            font-size: 1.25rem !important; /* Increases the main menu size */
        }
        
        .navbar-nav .dropdown-item {
            font-size: 1.15rem !important; /* Increases the dropdown menu size */
        }
    </style>
</head>

<body>
    <div class="py-2 bg-white d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center text-md-start fw-medium"
                    style="font-size: 0.9rem; font-family: 'Kalpurush', Arial, sans-serif; color: #333;">
                    @php
                        $engDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                        $bngDays = ['রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার'];
                        $engMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                        $bngMonths = ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
                        $engNum = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                        $bngNum = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

                        $currentDayName = str_replace($engDays, $bngDays, date('l'));
                        $currentMonth = str_replace($engMonths, $bngMonths, date('F'));
                        $currentDay = str_replace($engNum, $bngNum, date('d'));
                        $currentYear = str_replace($engNum, $bngNum, date('Y'));

                        $gregorianDate = "{$currentDayName} {$currentDay} {$currentMonth} {$currentYear} খ্রিস্টাব্দ";
                        $banglaDate = $siteSetting->bangla_date ?? '১৭ চৈত্র ১৪৩২ বঙ্গাব্দ';
                        $hijriDate = $siteSetting->hijri_date ?? '১১ শাওয়াল ১৪৪৭ হিজরি';
                    @endphp
                    <i class="fa-regular fa-calendar me-1 text-danger"></i>
                    {{ $gregorianDate }} || {{ $banglaDate }} || {{ $hijriDate }}
                </div>
            </div>
        </div>
    </div>

    <div class="container py-2 py-md-3 bg-white">
        <div class="row align-items-center">

            <div class="col-lg-2 col-md-2 d-none d-md-flex gap-3">
                <a href="{{ $siteSetting->app_url ?? '#' }}" target="_blank"
                    class="text-dark fs-5 text-decoration-none hover-red"><i class="fa-solid fa-mobile-screen"></i></a>
                <a href="{{ $siteSetting->facebook_url ?? '#' }}" target="_blank"
                    class="text-dark fs-5 text-decoration-none hover-red"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="{{ $siteSetting->twitter_url ?? '#' }}" target="_blank"
                    class="text-dark fs-5 text-decoration-none hover-red"><i class="fa-brands fa-twitter"></i></a>
            </div>

            <div class="col-12 col-md-6 col-lg-7 d-flex flex-row align-items-center justify-content-between justify-content-md-center gap-2">

                <a href="{{ route('home') }}" class="text-decoration-none flex-shrink-0 me-md-2">
                    @if (isset($siteSetting) && $siteSetting->site_logo)
                        <img id="print-logo" src="{{ $siteSetting->site_logo }}" alt="{{ $siteSetting->site_name }}"
                            style="width: 220px !important; height: auto !important; max-width: 100% !important; display: block;">
                    @else
                        <h1 id="print-title" class="text-danger m-0 fw-bold"
                            style="font-family: Georgia, serif; letter-spacing: 1px; text-transform: uppercase; font-size: 1.1rem;">
                            {{ $siteSetting->site_name ?? 'GLOBAL TIMES' }}
                        </h1>
                    @endif
                </a>

                <div id="live-radio-player-wrapper" data-turbo-permanent="true" class="flex-shrink-1 d-print-none"
                        style="min-width: 100px; max-width: 250px;"> <div class="radio-player-card bg-white border border-danger shadow-sm rounded-pill p-1 px-md-2 py-md-1 d-flex align-items-center">

                        <audio id="mahananda-stream" preload="none"></audio>

                        <button id="radio-play-btn"
                            class="btn btn-danger rounded-circle shadow-sm d-flex align-items-center justify-content-center flex-shrink-0 play-btn">
                            <i class="fa-solid fa-play ms-1" style="font-size: 0.75rem;" id="radio-icon"></i>
                        </button>

                        <div class="radio-info mx-2 flex-grow-1 text-start">
                            <div class="d-flex align-items-center mb-1">
                                <span
                                    class="live-badge badge bg-danger rounded-pill d-flex align-items-center px-1 py-1"
                                    style="font-size: 0.45rem;">
                                    <span class="live-dot me-1"></span> LIVE
                                </span>
                                <strong class="ms-1 text-dark radio-text"
                                    style="font-family: 'Kalpurush', Arial, sans-serif; line-height: 1; white-space: nowrap;"></strong>
                            </div>

                            <div class="sound-bars d-flex align-items-end" id="sound-visualizer">
                                <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
                            </div>
                        </div>

                        <div class="volume-control d-none d-lg-flex align-items-center me-1" style="width: 60px;">
                            <i class="fa-solid fa-volume-high text-secondary me-1" style="font-size: 0.8rem;" id="volume-icon"></i>
                            <input type="range" id="volume-slider" min="0" max="1" step="0.01"
                                value="1" class="form-range" style="height: 4px;">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-md-4 d-none d-md-flex justify-content-end d-print-none">
                <form action="{{ route('search') }}" method="GET" class="d-flex w-100" style="max-width: 250px;">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control rounded-0 border-danger border-end-0"
                            placeholder="Search news..." value="{{ request('q') }}" required
                            style="box-shadow: none;">
                        <button class="btn btn-danger rounded-0 px-3" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-top border-bottom shadow-sm sticky-top z-3 d-print-none">
        <div class="container">
            <button class="navbar-toggler rounded-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                @php
                    // মূল মেনু থেকে আগেরগুলো সরিয়ে নতুন সিকোয়েন্স দেওয়া হলো
                    $menuSequence = [
                        'চাঁপাইনবাবগঞ্জ', 
                        'রাজশাহী',
                        'নওগাঁ',
                        'জাতীয়', 
                        'আন্তর্জাতিক',
                        'খেলাধুলা',
                        'বিনোদন',
                    ];

                    $dbCategories = \App\Models\Category::with('subcategories')->get();
                @endphp

                <ul class="navbar-nav mx-auto gap-3 fw-bold" style="font-size: 1.1rem;">

                    <li class="nav-item">
                        <a class="nav-link text-dark hover-red" href="{{ url('/') }}">নীড়</a>
                    </li>

                    @foreach ($menuSequence as $menuName)
                        @php
                            $category = $dbCategories->firstWhere('name', $menuName);
                        @endphp

                        @if ($category && $category->subcategories->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark hover-red" href="#"
                                    data-bs-toggle="dropdown">
                                    {{ $menuName }}
                                </a>
                                <ul class="dropdown-menu shadow border-0 rounded-0 m-0 border-top border-danger border-2">
                                    @foreach ($category->subcategories as $subcat)
                                        <li><a class="dropdown-item py-2 hover-red"
                                                href="{{ route('category', $subcat->name) }}">{{ $subcat->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-dark hover-red"
                                    href="{{ route('category', $menuName) }}">{{ $menuName }}</a>
                            </li>
                        @endif
                    @endforeach

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark hover-red" href="#" data-bs-toggle="dropdown">
                            অন্যান্য
                        </a>
                        <ul class="dropdown-menu shadow border-0 rounded-0 m-0 border-top border-danger border-2">
                            <li><a class="dropdown-item py-2 hover-red" href="{{ route('category', 'বিজ্ঞান ও প্রযুক্তি') }}">বিজ্ঞান ও প্রযুক্তি</a></li>
                            <li><a class="dropdown-item py-2 hover-red" href="{{ route('category', 'লাইফস্টাইল') }}">লাইফস্টাইল</a></li>
                            <li><a class="dropdown-item py-2 hover-red" href="{{ route('category', 'সম্পাদকীয়') }}">সম্পাদকীয়</a></li>
                            <li><a class="dropdown-item py-2 hover-red" href="{{ route('category', 'উপসম্পাদকীয়') }}">উপসম্পাদকীয়</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark hover-red" href="{{ url('/contact') }}">যোগাযোগ</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <main>
        @php
            $tickerNews = \App\Models\Article::where('status', 'published')->latest()->take(10)->get();
        @endphp

        @if ($tickerNews->count() > 0)
            <div class="container my-3 d-print-none">
                <div class="d-flex align-items-center border border-danger rounded-0 shadow-sm bg-white overflow-hidden"
                    style="height: 45px;">
                    <div class="bg-danger text-white px-3 fw-bold d-flex align-items-center h-100 z-2 position-relative"
                        style="white-space: nowrap; font-family: 'Kalpurush', Arial, sans-serif; font-size: 1.1rem; min-width: max-content;">
                        <i class="fa-solid fa-bolt me-2 text-warning"></i> শিরোনাম
                        <div class="position-absolute top-0 start-100 h-100"
                            style="width: 0; height: 0; border-top: 22.5px solid transparent; border-bottom: 22.5px solid transparent; border-left: 15px solid #dc3545;">
                        </div>
                    </div>

                    <div
                        class="ticker-wrapper flex-grow-1 overflow-hidden position-relative h-100 ps-4 d-flex align-items-center">
                        <div class="ticker-content">
                            @foreach ($tickerNews as $news)
                                <a href="{{ route('article.show', $news->id) }}"
                                    class="text-dark text-decoration-none mx-4 hover-red fw-medium"
                                    style="font-size: 1.05rem;">
                                    <i class="fa-solid fa-circle-notch fa-xs text-danger me-2"></i>{{ $news->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-dark text-white pt-5 mt-5 d-print-none">
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
                    <p class="mb-1 small text-light opacity-75">
                        {{ $siteSetting->contact_address ?? 'বেলেপুকুর, চাঁপাইনবাবগঞ্জ।' }}</p>
                    <p class="mb-1 small text-light opacity-75"><strong>ফোনঃ</strong>
                        {{ $siteSetting->contact_phone ?? '+02588892975' }}</p>
                    <p class="mb-0 small text-light opacity-75"><strong>ফ্যাক্সঃ</strong>
                        {{ $siteSetting->contact_fax ?? '+02588892601' }}</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-light">মোবাইলঃ</h6>
                    <p class="mb-1 small text-light opacity-75">
                        {{ $siteSetting->contact_mobile ?? '01713248558, 01713248560' }}</p>
                    <p class="mb-1 small text-light opacity-75 mt-2"><strong>ই-মেইলঃ</strong></p>
                    <p class="mb-0 small text-light opacity-75">
                        {{ $siteSetting->contact_email ?? 'sm@radiomahananda.fm' }}</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-light">মোবাইল অ্যাপ</h6>
                    <p class="mb-3 small text-light opacity-75">ডাউনলোড করুন</p>
                    <a href="https://play.google.com/store/apps/details?id=com.radiomahananda.news&pcampaignid=web_share"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                            alt="Get it on Google Play" style="width: 140px;"></a>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const audio = document.getElementById('mahananda-stream');
            const playBtn = document.getElementById('radio-play-btn');
            const icon = document.getElementById('radio-icon');
            const visualizer = document.getElementById('sound-visualizer');
            const volumeSlider = document.getElementById('volume-slider');
            const volumeIcon = document.getElementById('volume-icon');
            const streamUrl = "https://centova47.instainternet.com/proxy/bspmorui?mp=/stream";

            playBtn.addEventListener('click', function() {
                if (audio.paused || !audio.src) {
                    icon.className = "fa-solid fa-spinner fa-spin ms-1";
                    icon.style.fontSize = "0.85rem"; // Keeps icon perfectly centered

                    if (!audio.src || audio.src === window.location.href) {
                        audio.src = streamUrl;
                        audio.load();
                    }

                    audio.play().then(() => {
                        icon.className = "fa-solid fa-pause";
                        icon.style.fontSize = "0.85rem";
                        playBtn.classList.remove('ms-1');
                        visualizer.classList.add('playing');
                    }).catch((error) => {
                        console.error("Audio playback failed:", error);
                        icon.className = "fa-solid fa-play ms-1";
                        alert("Unable to connect to the radio stream. Please try again.");
                    });
                } else {
                    audio.pause();
                    audio.removeAttribute('src');
                    audio.load();
                    icon.className = "fa-solid fa-play ms-1";
                    icon.style.fontSize = "0.85rem";
                    playBtn.classList.add('ms-1');
                    visualizer.classList.remove('playing');
                }
            });

            volumeSlider.addEventListener('input', function() {
                audio.volume = this.value;
                if (this.value == 0) {
                    volumeIcon.className = "fa-solid fa-volume-xmark text-secondary me-2 fs-6";
                } else if (this.value < 0.5) {
                    volumeIcon.className = "fa-solid fa-volume-low text-secondary me-2 fs-6";
                } else {
                    volumeIcon.className = "fa-solid fa-volume-high text-secondary me-2 fs-6";
                }
            });
        });
    </script>
</body>

</html>