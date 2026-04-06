@extends('layouts.frontend')

@section('content')
<div class="container mt-4">
    
    <div class="row g-2 mb-5"> 
        
        <div class="col-lg-6">
            @if(isset($sliderArticles) && $sliderArticles->count() > 0)
                <div id="heroCarousel" class="carousel slide h-100 carousel-fade" data-bs-ride="carousel">
                    
                    <div class="carousel-indicators">
                        @foreach($sliderArticles as $index => $article)
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner h-100">
                        @foreach($sliderArticles as $index => $article)
                            <div class="carousel-item h-100 {{ $index == 0 ? 'active' : '' }}" data-bs-interval="4000">
                                <div class="card h-100 border-0 rounded-0 overflow-hidden text-white position-relative" style="min-height: 420px;">
                                    <img src="{{ $article->image_url ?? 'https://placehold.co/800x600/eeeeee/999999?text=No+Image' }}" class="w-100 h-100 object-fit-cover position-absolute" alt="News Image">
                                    
                                    <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 60%);">
                                        <h2 class="card-title fw-bold mb-2" style="line-height: 1.3;">
                                            <a href="{{ route('article.show', $article->id) }}" class="text-white text-decoration-none hover-red">
                                                {{ $article->title }}
                                            </a>
                                        </h2>
                                        
                                        <div class="text-light mb-2" style="font-size: 0.85rem; opacity: 0.9;">
                                            <!--<span class="badge bg-danger me-2">{{ $article->category }}</span>-->
                                            <i class="fa-regular fa-calendar me-1"></i> {{ $article->created_at->format('M d, Y') }} 
                                        </div>
                                        
                                        <p class="card-text text-light d-none d-md-block" style="opacity: 0.85; font-size: 0.95rem;">
                                            {{ Str::limit(strip_tags($article->excerpt ?? $article->content), 120) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="col-lg-6">
            <div class="row h-100 g-2"> 
                @if(isset($gridArticles))
                    @foreach($gridArticles as $article)
                        <div class="col-6">
                            <div class="card h-100 border-0 rounded-0 overflow-hidden text-white position-relative" style="min-height: 205px;">
                                <img src="{{ $article->image_url ?? 'https://placehold.co/400x300/eeeeee/999999?text=No+Image' }}" class="w-100 h-100 object-fit-cover position-absolute" alt="News Image">
                                
                                <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 70%);">
                                    <h6 class="card-title fw-bold mb-2" style="line-height: 1.4; font-size: 0.95rem;">
                                        <a href="{{ route('article.show', $article->id) }}" class="text-white text-decoration-none hover-red">
                                            {{ Str::limit($article->title, 60) }}
                                        </a>
                                    </h6>
                                    
                                    <div class="text-light" style="font-size: 0.75rem; opacity: 0.9;">
                                        <i class="fa-regular fa-calendar me-1"></i> {{ $article->created_at->format('M d, Y') }} 
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        
    </div>

    <div class="container my-4 d-print-none">
        <style>
            .region-btn-card img {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border-radius: 12px;
                height: 110px;
                width: 100%;
                object-fit: cover;
            }
            .region-btn-card:hover img {
                transform: translateY(-4px);
                box-shadow: 0 8px 15px rgba(0,0,0,0.15) !important;
            }
            .region-btn-text {
                font-family: 'Tiro Bangla', serif;
                font-size: 1.05rem;
                color: #555;
                transition: color 0.2s ease;
            }
            .region-btn-card:hover .region-btn-text {
                color: #dc3545;
            }
        </style>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 justify-content-center">
            <div class="col">
                <a href="{{ route('category', 'চাঁপাইনবাবগঞ্জ সদর') }}" class="text-decoration-none region-btn-card d-block text-center">
                    <img src="{{ asset('images/regions/sadar.jpg') }}" class="shadow-sm mb-2" alt="চাঁপাইনবাবগঞ্জ সদর">
                    <div class="region-btn-text fw-bold">চাঁপাইনবাবগঞ্জ</div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('category', 'শিবগঞ্জ') }}" class="text-decoration-none region-btn-card d-block text-center">
                    <img src="{{ asset('images/regions/shibganj.jpg') }}" class="shadow-sm mb-2" alt="শিবগঞ্জ">
                    <div class="region-btn-text fw-bold ">শিবগঞ্জ</div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('category', 'ভোলাহাট') }}" class="text-decoration-none region-btn-card d-block text-center">
                    <img src="{{ asset('images/regions/bholahat.jpg') }}" class="shadow-sm mb-2" alt="ভোলাহাট">
                    <div class="region-btn-text fw-bold">ভোলাহাট</div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('category', 'গোমস্তাপুর') }}" class="text-decoration-none region-btn-card d-block text-center">
                    <img src="{{ asset('images/regions/gomastapur.jpg') }}" class="shadow-sm mb-2" alt="গোমস্তাপুর">
                    <div class="region-btn-text fw-bold">গোমস্তাপুর</div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('category', 'নাচোল') }}" class="text-decoration-none region-btn-card d-block text-center">
                    <img src="{{ asset('images/regions/nachol.jpg') }}" class="shadow-sm mb-2" alt="নাচোল">
                    <div class="region-btn-text fw-bold">নাচোল</div>
                </a>
            </div>
        </div>
    </div>
    
    <div class="row mt-5 mb-5">
        
        <div class="col-lg-4 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-tags me-1"></i> জাতীয়
                </h5>
            </div>
            
            @if(isset($bangladeshArticles) && $bangladeshArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $bangladeshArticles[0]->image_url ?? 'https://placehold.co/400x250/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 200px; object-fit: cover;">
                    <div class="card-body px-0 pt-2 pb-0">
                        <h5 class="card-title fw-bold mb-1"><a href="{{ route('article.show', $bangladeshArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $bangladeshArticles[0]->title }}</a></h5>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $bangladeshArticles[0]->created_at->format('M d, Y') }}</div>
                        <p class="card-text text-muted small" style="line-height: 1.4;">{{ Str::limit(strip_tags($bangladeshArticles[0]->excerpt ?? $bangladeshArticles[0]->content), 100) }}</p>
                    </div>
                </div>

                <div class="row g-2">
                    @for($i = 1; $i < min(3, $bangladeshArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $bangladeshArticles[$i]->image_url ?? 'https://placehold.co/200x150/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 110px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-0" style="font-size: 0.85rem; line-height: 1.3;"><a href="{{ route('article.show', $bangladeshArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($bangladeshArticles[$i]->title, 50) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('category', 'বাংলাদেশ') }}" class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-0 py-2 text-uppercase">See More <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-earth-americas me-1"></i> আন্তর্জাতিক
                </h5>
            </div>
            
            @if(isset($internationalArticles) && $internationalArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $internationalArticles[0]->image_url ?? 'https://placehold.co/400x250/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 200px; object-fit: cover;">
                    <div class="card-body px-0 pt-2 pb-0">
                        <h5 class="card-title fw-bold mb-1"><a href="{{ route('article.show', $internationalArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $internationalArticles[0]->title }}</a></h5>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $internationalArticles[0]->created_at->format('M d, Y') }}</div>
                        <p class="card-text text-muted small" style="line-height: 1.4;">{{ Str::limit(strip_tags($internationalArticles[0]->excerpt ?? $internationalArticles[0]->content), 100) }}</p>
                    </div>
                </div>

                <div class="row g-2">
                    @for($i = 1; $i < min(3, $internationalArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $internationalArticles[$i]->image_url ?? 'https://placehold.co/200x150/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 110px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-0" style="font-size: 0.85rem; line-height: 1.3;"><a href="{{ route('article.show', $internationalArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($internationalArticles[$i]->title, 50) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('category', 'আন্তর্জাতিক') }}" class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-0 py-2 text-uppercase">See More <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-regular fa-newspaper me-1"></i> সর্বশেষ খবর
                </h5>
            </div>

            @if(isset($recentPosts))
                <div class="d-flex flex-column gap-3 mb-4">
                    @foreach($recentPosts as $recent)
                        <div class="d-flex align-items-center">
                            <img src="{{ $recent->image_url ?? 'https://placehold.co/120x90/eeeeee/999999?text=No+Image' }}" class="rounded-0 object-fit-cover" style="width: 110px; height: 80px;">
                            <div class="ms-3">
                                <h6 class="fw-bold mb-1" style="font-size: 0.95rem; line-height: 1.3;">
                                    <a href="{{ route('article.show', $recent->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($recent->title, 55) }}</a>
                                </h6>
                                <div class="text-muted" style="font-size: 0.75rem;"><i class="fa-regular fa-calendar me-1"></i> {{ $recent->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(isset($siteSetting) && $siteSetting->homepage_ad_banner)
                <div class="mt-4 text-center">
                    <a href="{{ $siteSetting->homepage_ad_link ?? '#' }}" target="_blank">
                        <img src="{{ asset($siteSetting->homepage_ad_banner) }}" class="img-fluid w-100 object-fit-cover shadow-sm" style="max-height: 250px;" alt="Ad Space">
                    </a>
                </div>
            @else
                <div class="mt-4 text-center">
                    <span class="text-muted small d-block mb-1">- Advertisement -</span>
                    <img src="https://placehold.co/300x250/222222/ffffff?text=Advertisement\n300+x+250" class="img-fluid w-100 object-fit-cover shadow-sm" style="max-height: 250px;" alt="Ad Space">
                </div>
            @endif
        </div>

    </div>

    @if(isset($siteSetting) && $siteSetting->top_ad_banner)
        <div class="row mb-5">
            <div class="col-12 text-center">
                <a href="{{ $siteSetting->top_ad_link ?? '#' }}" target="_blank">
                    <img src="{{ asset($siteSetting->top_ad_banner) }}" class="img-fluid w-100 object-fit-cover shadow-sm rounded" style="max-height: 180px;" alt="Ad Space">
                </a>
            </div>
        </div>
    @endif

    <div class="row mt-5 mb-3">
        <div class="col-lg-6 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-futbol me-1"></i> খেলাধুলা
                </h5>
            </div>
            
            @if(isset($sportsArticles) && $sportsArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $sportsArticles[0]->image_url ?? 'https://placehold.co/600x350/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 280px; object-fit: cover;">
                    <div class="card-body px-0 pt-3 pb-0">
                        <h4 class="card-title fw-bold mb-2"><a href="{{ route('article.show', $sportsArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $sportsArticles[0]->title }}</a></h4>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $sportsArticles[0]->created_at->format('M d, Y') }}</div>
                        <p class="card-text text-muted" style="line-height: 1.5; font-size: 0.95rem;">{{ Str::limit(strip_tags($sportsArticles[0]->excerpt ?? $sportsArticles[0]->content), 120) }}</p>
                    </div>
                </div>

                <div class="row g-3">
                    @for($i = 1; $i < min(3, $sportsArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $sportsArticles[$i]->image_url ?? 'https://placehold.co/300x200/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 150px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-1" style="font-size: 0.95rem; line-height: 1.3;"><a href="{{ route('article.show', $sportsArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($sportsArticles[$i]->title, 60) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('category', 'খেলাধুলা') }}" class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-0 py-2 text-uppercase">See More <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-pen-nib me-1"></i> সম্পাদকীয়
                </h5>
            </div>
            
            @if(isset($editorialArticles) && $editorialArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $editorialArticles[0]->image_url ?? 'https://placehold.co/600x350/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 280px; object-fit: cover;">
                    <div class="card-body px-0 pt-3 pb-0">
                        <h4 class="card-title fw-bold mb-2"><a href="{{ route('article.show', $editorialArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $editorialArticles[0]->title }}</a></h4>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $editorialArticles[0]->created_at->format('M d, Y') }}</div>
                        <p class="card-text text-muted" style="line-height: 1.5; font-size: 0.95rem;">{{ Str::limit(strip_tags($editorialArticles[0]->excerpt ?? $editorialArticles[0]->content), 120) }}</p>
                    </div>
                </div>

                <div class="row g-3">
                    @for($i = 1; $i < min(3, $editorialArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $editorialArticles[$i]->image_url ?? 'https://placehold.co/300x200/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 150px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-1" style="font-size: 0.95rem; line-height: 1.3;"><a href="{{ route('article.show', $editorialArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($editorialArticles[$i]->title, 60) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('category', 'সম্পাদকীয়') }}" class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-0 py-2 text-uppercase">See More <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        
        <div class="col-lg-4 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-microchip me-1"></i> বিজ্ঞান ও প্রযুক্তি
                </h5>
            </div>
            
            @if(isset($techArticles) && $techArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $techArticles[0]->image_url ?? 'https://placehold.co/400x250/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 200px; object-fit: cover;">
                    <div class="card-body px-0 pt-2 pb-0">
                        <h5 class="card-title fw-bold mb-1"><a href="{{ route('article.show', $techArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $techArticles[0]->title }}</a></h5>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $techArticles[0]->created_at->format('M d, Y') }}</div>
                        <p class="card-text text-muted small" style="line-height: 1.4;">{{ Str::limit(strip_tags($techArticles[0]->excerpt ?? $techArticles[0]->content), 100) }}</p>
                    </div>
                </div>

                <div class="row g-2">
                    @for($i = 1; $i < min(3, $techArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $techArticles[$i]->image_url ?? 'https://placehold.co/200x150/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 110px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-0" style="font-size: 0.85rem; line-height: 1.3;"><a href="{{ route('article.show', $techArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($techArticles[$i]->title, 50) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('category', 'বিজ্ঞান ও প্রযুক্তি') }}" class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-0 py-2 text-uppercase">See More <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-film me-1"></i> বিনোদন
                </h5>
            </div>
            
            @if(isset($entertainmentArticles) && $entertainmentArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $entertainmentArticles[0]->image_url ?? 'https://placehold.co/400x250/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 200px; object-fit: cover;">
                    <div class="card-body px-0 pt-2 pb-0">
                        <h5 class="card-title fw-bold mb-1"><a href="{{ route('article.show', $entertainmentArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $entertainmentArticles[0]->title }}</a></h5>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $entertainmentArticles[0]->created_at->format('M d, Y') }}</div>
                        <p class="card-text text-muted small" style="line-height: 1.4;">{{ Str::limit(strip_tags($entertainmentArticles[0]->excerpt ?? $entertainmentArticles[0]->content), 100) }}</p>
                    </div>
                </div>

                <div class="row g-2">
                    @for($i = 1; $i < min(3, $entertainmentArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $entertainmentArticles[$i]->image_url ?? 'https://placehold.co/200x150/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 110px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-0" style="font-size: 0.85rem; line-height: 1.3;"><a href="{{ route('article.show', $entertainmentArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($entertainmentArticles[$i]->title, 50) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('category', 'বিনোদন') }}" class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-0 py-2 text-uppercase">See More <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-mug-hot me-1"></i> লাইফস্টাইল
                </h5>
            </div>
            
            @if(isset($lifestyleArticles) && $lifestyleArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $lifestyleArticles[0]->image_url ?? 'https://placehold.co/400x250/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 200px; object-fit: cover;">
                    <div class="card-body px-0 pt-2 pb-0">
                        <h5 class="card-title fw-bold mb-1"><a href="{{ route('article.show', $lifestyleArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $lifestyleArticles[0]->title }}</a></h5>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $lifestyleArticles[0]->created_at->format('M d, Y') }}</div>
                        <p class="card-text text-muted small" style="line-height: 1.4;">{{ Str::limit(strip_tags($lifestyleArticles[0]->excerpt ?? $lifestyleArticles[0]->content), 100) }}</p>
                    </div>
                </div>

                <div class="row g-2">
                    @for($i = 1; $i < min(3, $lifestyleArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $lifestyleArticles[$i]->image_url ?? 'https://placehold.co/200x150/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 110px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-0" style="font-size: 0.85rem; line-height: 1.3;"><a href="{{ route('article.show', $lifestyleArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($lifestyleArticles[$i]->title, 50) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('category', 'লাইফস্টাইল') }}" class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-0 py-2 text-uppercase">See More <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>

    </div>
    
</div>

<style>
    .object-fit-cover { object-fit: cover; }
    .hover-red:hover { color: #dc3545 !important; transition: color 0.2s ease-in-out; }
</style>
@endsection