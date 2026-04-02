@extends('layouts.frontend')

@section('content')
<div class="container mt-4">
    
    <div class="row g-2 mb-5"> 
        
        <div class="col-lg-6">
            @if(isset($heroBlocks[0]))
                <div class="card h-100 border-0 rounded-0 overflow-hidden text-white position-relative" style="min-height: 420px;">
                    <img src="{{ $heroBlocks[0]['article']->image_url ?? 'https://placehold.co/800x600/eeeeee/999999?text=No+Image' }}" class="w-100 h-100 object-fit-cover position-absolute" alt="News Image">
                    
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 60%);">
                        <h2 class="card-title fw-bold mb-2" style="line-height: 1.3;">
                            <a href="{{ route('article.show', $heroBlocks[0]['article']->id) }}" class="text-white text-decoration-none hover-red">
                                {{ $heroBlocks[0]['article']->title }}
                            </a>
                        </h2>
                        
                        <div class="text-light mb-2" style="font-size: 0.85rem; opacity: 0.9;">
                            <i class="fa-regular fa-calendar me-1"></i> {{ $heroBlocks[0]['article']->created_at->format('M d, Y') }} 
                            {{-- <i class="fa-regular fa-user ms-3 me-1"></i> {{ $heroBlocks[0]['article']->user->name ?? 'Unknown' }} --}}
                        </div>
                        
                        <p class="card-text text-light d-none d-md-block" style="opacity: 0.85; font-size: 0.95rem;">
                            {{ Str::limit(strip_tags($heroBlocks[0]['article']->excerpt ?? $heroBlocks[0]['article']->content), 120) }}
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-6">
            <div class="row h-100 g-2"> 
                @for($i = 1; $i < 5; $i++)
                    @if(isset($heroBlocks[$i]))
                        <div class="col-6">
                            <div class="card h-100 border-0 rounded-0 overflow-hidden text-white position-relative" style="min-height: 205px;">
                                <img src="{{ $heroBlocks[$i]['article']->image_url ?? 'https://placehold.co/400x300/eeeeee/999999?text=No+Image' }}" class="w-100 h-100 object-fit-cover position-absolute" alt="News Image">
                                
                                <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 70%);">
                                    <h6 class="card-title fw-bold mb-2" style="line-height: 1.4; font-size: 0.95rem;">
                                        <a href="{{ route('article.show', $heroBlocks[$i]['article']->id) }}" class="text-white text-decoration-none hover-red">
                                            {{ Str::limit($heroBlocks[$i]['article']->title, 60) }}
                                        </a>
                                    </h6>
                                    
                                    <div class="text-light" style="font-size: 0.75rem; opacity: 0.9;">
                                        <i class="fa-regular fa-calendar me-1"></i> {{ $heroBlocks[$i]['article']->created_at->format('M d, Y') }} 
                                        {{-- <i class="fa-regular fa-user ms-2 me-1"></i> {{ $heroBlocks[$i]['article']->user->name ?? 'Unknown' }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
    
    <div class="row mt-5 mb-5">
        
        <div class="col-lg-4 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-tags me-1"></i> চাঁপাইনবাবগঞ্জ সদর
                </h5>
            </div>
            
            @if(isset($chapaiArticles) && $chapaiArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $chapaiArticles[0]->image_url ?? 'https://placehold.co/400x250/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 200px; object-fit: cover;">
                    <div class="card-body px-0 pt-2 pb-0">
                        <h5 class="card-title fw-bold mb-1"><a href="{{ route('article.show', $chapaiArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $chapaiArticles[0]->title }}</a></h5>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $chapaiArticles[0]->created_at->format('M d, Y') }} {{-- <i class="fa-regular fa-user ms-2 me-1"></i> {{ $chapaiArticles[0]->user->name ?? 'Unknown' }} --}}</div>
                        <p class="card-text text-muted small" style="line-height: 1.4;">{{ Str::limit(strip_tags($chapaiArticles[0]->excerpt ?? $chapaiArticles[0]->content), 100) }}</p>
                    </div>
                </div>

                <div class="row g-2">
                    @for($i = 1; $i < min(3, $chapaiArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $chapaiArticles[$i]->image_url ?? 'https://placehold.co/200x150/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 110px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-0" style="font-size: 0.85rem; line-height: 1.3;"><a href="{{ route('article.show', $chapaiArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($chapaiArticles[$i]->title, 50) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('category', 'চাঁপাইনবাবগঞ্জ সদর') }}" class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-0 py-2 text-uppercase">See More <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-tags me-1"></i> বাংলাদেশ
                </h5>
            </div>
            
            @if(isset($bangladeshArticles) && $bangladeshArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $bangladeshArticles[0]->image_url ?? 'https://placehold.co/400x250/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 200px; object-fit: cover;">
                    <div class="card-body px-0 pt-2 pb-0">
                        <h5 class="card-title fw-bold mb-1"><a href="{{ route('article.show', $bangladeshArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $bangladeshArticles[0]->title }}</a></h5>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $bangladeshArticles[0]->created_at->format('M d, Y') }} {{-- <i class="fa-regular fa-user ms-2 me-1"></i> {{ $bangladeshArticles[0]->user->name ?? 'Unknown' }} --}}</div>
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

    <div class="row mt-5 mb-5">
        
        <div class="col-lg-6 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-earth-americas me-1"></i> আন্তর্জাতিক
                </h5>
            </div>
            
            @if(isset($internationalArticles) && $internationalArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $internationalArticles[0]->image_url ?? 'https://placehold.co/600x350/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 280px; object-fit: cover;">
                    <div class="card-body px-0 pt-3 pb-0">
                        <h4 class="card-title fw-bold mb-2"><a href="{{ route('article.show', $internationalArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $internationalArticles[0]->title }}</a></h4>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $internationalArticles[0]->created_at->format('M d, Y') }} {{-- <i class="fa-regular fa-user ms-2 me-1"></i> {{ $internationalArticles[0]->user->name ?? 'Unknown' }} --}}</div>
                        <p class="card-text text-muted" style="line-height: 1.5; font-size: 0.95rem;">{{ Str::limit(strip_tags($internationalArticles[0]->excerpt ?? $internationalArticles[0]->content), 120) }}</p>
                    </div>
                </div>

                <div class="row g-3">
                    @for($i = 1; $i < min(3, $internationalArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $internationalArticles[$i]->image_url ?? 'https://placehold.co/300x200/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 150px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-1" style="font-size: 0.95rem; line-height: 1.3;"><a href="{{ route('article.show', $internationalArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($internationalArticles[$i]->title, 60) }}</a></h6>
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

        <div class="col-lg-6 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-location-dot me-1"></i> শিবগঞ্জ
                </h5>
            </div>
            
            @if(isset($shibganjArticles) && $shibganjArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $shibganjArticles[0]->image_url ?? 'https://placehold.co/600x350/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 280px; object-fit: cover;">
                    <div class="card-body px-0 pt-3 pb-0">
                        <h4 class="card-title fw-bold mb-2"><a href="{{ route('article.show', $shibganjArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $shibganjArticles[0]->title }}</a></h4>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $shibganjArticles[0]->created_at->format('M d, Y') }} {{-- <i class="fa-regular fa-user ms-2 me-1"></i> {{ $shibganjArticles[0]->user->name ?? 'Unknown' }} --}}</div>
                        <p class="card-text text-muted" style="line-height: 1.5; font-size: 0.95rem;">{{ Str::limit(strip_tags($shibganjArticles[0]->excerpt ?? $shibganjArticles[0]->content), 120) }}</p>
                    </div>
                </div>

                <div class="row g-3">
                    @for($i = 1; $i < min(3, $shibganjArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $shibganjArticles[$i]->image_url ?? 'https://placehold.co/300x200/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 150px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-1" style="font-size: 0.95rem; line-height: 1.3;"><a href="{{ route('article.show', $shibganjArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($shibganjArticles[$i]->title, 60) }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('category', 'শিবগঞ্জ') }}" class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-0 py-2 text-uppercase">See More <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
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

    <div class="row mt-5 mb-5">
        
        <div class="col-lg-6 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-film me-1"></i> বিনোদন
                </h5>
            </div>
            
            @if(isset($entertainmentArticles) && $entertainmentArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $entertainmentArticles[0]->image_url ?? 'https://placehold.co/600x350/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 280px; object-fit: cover;">
                    <div class="card-body px-0 pt-3 pb-0">
                        <h4 class="card-title fw-bold mb-2"><a href="{{ route('article.show', $entertainmentArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $entertainmentArticles[0]->title }}</a></h4>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $entertainmentArticles[0]->created_at->format('M d, Y') }} {{-- <i class="fa-regular fa-user ms-2 me-1"></i> {{ $entertainmentArticles[0]->user->name ?? 'Unknown' }} --}}</div>
                        <p class="card-text text-muted" style="line-height: 1.5; font-size: 0.95rem;">{{ Str::limit(strip_tags($entertainmentArticles[0]->excerpt ?? $entertainmentArticles[0]->content), 120) }}</p>
                    </div>
                </div>

                <div class="row g-3">
                    @for($i = 1; $i < min(3, $entertainmentArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $entertainmentArticles[$i]->image_url ?? 'https://placehold.co/300x200/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 150px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-1" style="font-size: 0.95rem; line-height: 1.3;"><a href="{{ route('article.show', $entertainmentArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($entertainmentArticles[$i]->title, 60) }}</a></h6>
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
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $sportsArticles[0]->created_at->format('M d, Y') }} {{-- <i class="fa-regular fa-user ms-2 me-1"></i> {{ $sportsArticles[0]->user->name ?? 'Unknown' }} --}}</div>
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

    </div>

    <div class="row mt-5 mb-5">
        
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
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $editorialArticles[0]->created_at->format('M d, Y') }} {{-- <i class="fa-regular fa-user ms-2 me-1"></i> {{ $editorialArticles[0]->user->name ?? 'Unknown' }} --}}</div>
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

        <div class="col-lg-6 mb-4">
            <div class="mb-3 border-bottom border-danger border-2">
                <h5 class="bg-danger text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                    <i class="fa-solid fa-mug-hot me-1"></i> লাইফস্টাইল
                </h5>
            </div>
            
            @if(isset($lifestyleArticles) && $lifestyleArticles->count() > 0)
                <div class="card border-0 mb-3">
                    <img src="{{ $lifestyleArticles[0]->image_url ?? 'https://placehold.co/600x350/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 280px; object-fit: cover;">
                    <div class="card-body px-0 pt-3 pb-0">
                        <h4 class="card-title fw-bold mb-2"><a href="{{ route('article.show', $lifestyleArticles[0]->id) }}" class="text-dark text-decoration-none hover-red">{{ $lifestyleArticles[0]->title }}</a></h4>
                        <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $lifestyleArticles[0]->created_at->format('M d, Y') }} {{-- <i class="fa-regular fa-user ms-2 me-1"></i> {{ $lifestyleArticles[0]->user->name ?? 'Unknown' }} --}}</div>
                        <p class="card-text text-muted" style="line-height: 1.5; font-size: 0.95rem;">{{ Str::limit(strip_tags($lifestyleArticles[0]->excerpt ?? $lifestyleArticles[0]->content), 120) }}</p>
                    </div>
                </div>

                <div class="row g-3">
                    @for($i = 1; $i < min(3, $lifestyleArticles->count()); $i++)
                        <div class="col-6">
                            <div class="card border-0">
                                <img src="{{ $lifestyleArticles[$i]->image_url ?? 'https://placehold.co/300x200/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0" style="height: 150px; object-fit: cover;">
                                <div class="card-body px-0 pt-2 pb-0">
                                    <h6 class="card-title fw-bold mb-1" style="font-size: 0.95rem; line-height: 1.3;"><a href="{{ route('article.show', $lifestyleArticles[$i]->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($lifestyleArticles[$i]->title, 60) }}</a></h6>
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