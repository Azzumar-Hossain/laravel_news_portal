@extends('layouts.frontend')

@section('content')
<div class="container mt-4 mb-5">
    
    <div class="row">
        
        <div class="col-lg-8 mb-5">
            
            <div class="mb-4 border-bottom border-danger border-3 pb-2">
                <h2 class="fw-bold m-0" style="color: #1a1a1a;">
                    <i class="fa-solid fa-magnifying-glass text-danger me-2"></i> Search Results for: "<span class="text-danger">{{ $query }}</span>"
                </h2>
                <p class="text-muted mt-2 mb-0">Found {{ $articles->total() }} articles matching your search.</p>
            </div>

            @if($articles->count() > 0)
                <div class="row g-4">
                    @foreach($articles as $article)
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm overflow-hidden">
                                <a href="{{ route('article.show', $article->id) }}">
                                    <img src="{{ $article->image_url ?? 'https://placehold.co/400x250/eeeeee/999999?text=No+Image' }}" class="card-img-top rounded-0 object-fit-cover hover-zoom" style="height: 200px;">
                                </a>
                                <div class="card-body d-flex flex-column pt-3">
                                    <h5 class="card-title fw-bold mb-2" style="line-height: 1.4;">
                                        <a href="{{ route('article.show', $article->id) }}" class="text-dark text-decoration-none hover-red">{{ $article->title }}</a>
                                    </h5>
                                    <div class="text-muted small mb-2">
                                        <i class="fa-regular fa-calendar me-1"></i> {{ $article->created_at->format('M d, Y') }} 
                                    </div>
                                    <p class="card-text text-muted small flex-grow-1" style="line-height: 1.5;">
                                        {{ Str::limit(strip_tags($article->excerpt ?? $article->content), 100) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $articles->appends(['q' => $query])->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-light text-center py-5 border">
                    <i class="fa-solid fa-face-frown fs-1 text-muted mb-3"></i>
                    <h4 class="text-muted">No results found for "{{ $query }}"</h4>
                    <p class="mb-0">Try searching for different keywords or check your spelling.</p>
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
        </div>

    </div>
</div>

<style>
    .object-fit-cover { object-fit: cover; }
    .hover-red:hover { color: #dc3545 !important; transition: color 0.2s ease-in-out; }
    .hover-zoom { transition: transform 0.3s ease; }
    .card:hover .hover-zoom { transform: scale(1.05); }
</style>
@endsection