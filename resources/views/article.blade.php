@extends('layouts.frontend')

@section('content')
<div class="container mt-4 mb-5">
    
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb" style="font-size: 0.9rem;">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-danger"><i class="fa-solid fa-house"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category', $article->category) }}" class="text-decoration-none text-danger">{{ $article->category == 'বাংলাদেশ' ? 'জাতীয়' : $article->category }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 40) }}</li>
        </ol>
    </nav>

    <div class="row">
        
        <div class="col-lg-8 mb-5" id="printable-area">
            
            <div class="d-none d-print-block mb-4">
                <div class="mt-2 mb-4 pb-2 border-bottom border-dark" style="font-size: 1rem;">Printed on: {{ date('F d, Y') }}</div>
                
                <div class="mb-3 text-dark" style="font-size: 1.1rem;">{{ $article->created_at->format('F d, Y') }}</div>
                <div class="mb-2 text-dark" style="font-size: 1.2rem;">{{ $article->category == 'বাংলাদেশ' ? 'জাতীয়' : $article->category }}</div>
            </div>

            <a href="{{ route('category', $article->category) }}" class="badge bg-danger text-decoration-none mb-3 px-3 py-2 d-print-none" style="font-size: 0.9rem;">
                {{ $article->category == 'বাংলাদেশ' ? 'জাতীয়' : $article->category }}
            </a>

            <h1 class="fw-bold mb-3 article-main-title" style="line-height: 1.3; font-size: 2.5rem; color: #1a1a1a;">
                {{ $article->title }}
            </h1>

            <div class="d-flex flex-wrap justify-content-between align-items-center border-top border-bottom py-3 mb-4 text-muted d-print-none">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div>
                        <div style="font-size: 0.85rem;"><i class="fa-regular fa-clock me-1"></i> Published: {{ $article->created_at->format('F d, Y \a\t h:i A') }}</div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    @php
                        $shareUrl = urlencode(route('article.show', $article->id));
                        $shareTitle = urlencode($article->title);
                    @endphp
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary" style="background-color: #3b5998; border: none;" title="Share on Facebook"><i class="fa-brands fa-facebook-f px-1"></i></a>
                    <a href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-info text-white" style="background-color: #1da1f2; border: none;" title="Share on Twitter"><i class="fa-brands fa-twitter px-1"></i></a>
                    <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success" style="background-color: #25d366; border: none;" title="Share on WhatsApp"><i class="fa-brands fa-whatsapp px-1"></i></a>

                    <button onclick="window.print()" class="btn btn-sm btn-secondary text-white ms-2" style="background-color: #4b5563; border: none;" title="Print Article">
                        <i class="fa-solid fa-print px-1"></i> Print
                    </button>
                </div>
            </div>

            <div class="clearfix">
                @if($article->image_url)
                    <div class="article-image-container mb-4 text-center">
                        <img src="{{ $article->image_url }}" class="img-fluid object-fit-cover shadow-sm" style="max-height: 500px;" alt="{{ $article->title }}">
                    </div>
                @endif

                <div class="article-content" style="font-size: 1.15rem; line-height: 1.8; color: #333;">
                    {!! $article->content !!}
                </div>
            </div>

            @if(isset($relatedArticles) && $relatedArticles->count() > 0)
                <div class="mt-5 pt-4 border-top d-print-none">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-danger" style="width: 5px; height: 25px;"></div>
                        <h4 class="fw-bold m-0 ms-2" style="font-family: 'Tiro Bangla', serif;">আরও পড়ুন</h4>
                    </div>
                    
                    <div class="row g-3">
                        @foreach($relatedArticles as $related)
                            <div class="col-md-6">
                                <div class="card h-100 border rounded-0 shadow-sm overflow-hidden">
                                    <a href="{{ route('article.show', $related->id) }}" class="text-decoration-none">
                                        <div class="row g-0 h-100">
                                            <div class="col-4">
                                                <img src="{{ $related->thumbnail_url ?? $related->image_url ?? 'https://placehold.co/150x150?text=No+Image' }}" class="w-100 h-100 object-fit-cover" alt="Related News">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-2 p-md-3 d-flex flex-column h-100 justify-content-center">
                                                    <h6 class="card-title fw-bold text-dark mb-1 hover-red" style="font-size: 0.95rem; line-height: 1.4;">
                                                        {{ Str::limit($related->title, 55) }}
                                                    </h6>
                                                    <small class="text-muted mt-auto" style="font-size: 0.75rem;">
                                                        <i class="fa-regular fa-clock me-1"></i> {{ $related->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            </div>


        <div class="col-lg-4 ps-lg-4">
            
            <div class="mb-5">
                <div class="mb-4 border-bottom border-dark border-2">
                    <h5 class="bg-dark text-white d-inline-block m-0 px-3 py-1 fw-bold text-uppercase" style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%); padding-right: 30px !important;">
                        <i class="fa-solid fa-bolt me-1 text-warning"></i> সর্বশেষ খবর
                    </h5>
                </div>

                <div class="d-flex flex-column gap-3">
                    @foreach($recentPosts as $recent)
                        <div class="d-flex align-items-center">
                            <img src="{{ $recent->image_url ?? 'https://placehold.co/100x80/eeeeee/999999?text=No+Image' }}" class="rounded-0 object-fit-cover shadow-sm" style="width: 100px; height: 75px;">
                            <div class="ms-3">
                                <h6 class="fw-bold mb-1" style="font-size: 0.95rem; line-height: 1.3;">
                                    <a href="{{ route('article.show', $recent->id) }}" class="text-dark text-decoration-none hover-red">{{ Str::limit($recent->title, 55) }}</a>
                                </h6>
                                <div class="text-muted" style="font-size: 0.75rem;"><i class="fa-regular fa-calendar me-1"></i> {{ $recent->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if(isset($siteSetting) && $siteSetting->sidebar_ad_banner)
                <div class="mt-4 text-center sticky-top" style="top: 120px; z-index: 1;">
                    <a href="{{ $siteSetting->sidebar_ad_link ?? '#' }}" target="_blank">
                        <img src="{{ asset($siteSetting->sidebar_ad_banner) }}" class="img-fluid w-100 object-fit-cover shadow-sm" alt="Ad Space">
                    </a>
                </div>
            @else
                <div class="mt-4 text-center sticky-top" style="top: 120px; z-index: 1;">
                    <span class="text-muted small d-block mb-1">- Advertisement -</span>
                    <img src="https://placehold.co/300x600/222222/ffffff?text=Sidebar+Ad\n300+x+600" class="img-fluid w-100 object-fit-cover shadow-sm" alt="Ad Space">
                </div>
            @endif

        </div>

    </div>
</div>

<style>
    .object-fit-cover { object-fit: cover; }
    .hover-red:hover { color: #dc3545 !important; transition: color 0.2s ease-in-out; }
    
    /* Make sure images inside the editor content are responsive */
    .article-content img {
        max-width: 100%;
        height: auto !important;
        margin-bottom: 1.5rem;
        border-radius: 4px;
    }
    .article-content p { margin-bottom: 1.5rem; }

    /* ==========================================
       Print Page Styling (Perfect Newspaper Flow)
       ========================================== */
    @media print {
        /* 1. Hide unwanted elements cleanly */
        body > .container.py-3.bg-white, /* Hides the top logo bar */
        nav, 
        footer, 
        form, /* Hides the search box */
        .col-lg-4, 
        .breadcrumb, 
        .d-print-none,
        iframe {
            display: none !important;
        }

        /* 2. KILL THE FLEXBOX PRINT BUG! (This fixes the blank white page) */
        .row, .col-lg-8, .container, main {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        /* 3. The magic float to put the image on the left */
        .article-image-container {
            float: left !important;
            width: 45% !important;
            margin: 0 25px 15px 0 !important;
            page-break-inside: avoid;
        }

        #printable-area img {
            width: 100% !important;
            height: auto !important;
            max-height: none !important;
            box-shadow: none !important;
        }
        
        /* 4. Format the text beautifully */
        .article-content { 
            text-align: justify !important; 
        }

        .article-main-title { 
            font-size: 2.2rem !important; 
            margin-bottom: 20px !important; 
        }
    }
</style>
@endsection