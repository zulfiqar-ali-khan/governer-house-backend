@extends('layouts.website')
@section('content')
    <!-- News Detail Content -->
    <section class="news-detail-section">
        <div class="container">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb news-detail-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news') }}">News & Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
                </ol>
            </nav>

            <span class="news-detail-tag">{{ strtoupper($news->type) }}</span>
            <h1 class="news-detail-title">{{ $news->title }}</h1>

            <!-- Meta Data -->
            <div class="news-detail-meta">
                <span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    {{ \Carbon\Carbon::parse($news->date)->format('F d, Y') }}
                </span>
                <span class="meta-dot">&bull;</span>
                <span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Written by {{ $news->author }}
                </span>
                <span class="meta-dot">&bull;</span>
                <span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    {{ $news->mint }} min read
                </span>
            </div>

            <!-- Featured Image -->
            <div class="news-detail-img-container">
                <img src="{{ asset($news->cover_image ?? $news->thumnail_image) }}" alt="{{ $news->title }}" class="news-detail-img">
            </div>

            <!-- Content -->
            <div class="news-detail-content">
                {!! $news->description !!}
            </div>


        </div>
    </section>

    <!-- Related News Section -->
    <section class="related-news-section pb-5">
        <div class="container py-4">
            <h2 class="related-news-title">Related News & Events</h2>
            <div class="row g-4 mt-2">
                @foreach($relatedNews as $related)
                <div class="col-lg-4 col-md-6">
                    <div class="related-card">
                        <img src="{{ asset($related->thumnail_image) }}" class="related-card-img" alt="{{ $related->title }}">
                        <div class="related-card-body">
                            <span class="related-card-tag tag-yellow">{{ strtoupper($related->type) }}</span>
                            <h4 class="related-card-title"><a href="{{ route('news-detail', ['slug' => $related->slug]) }}" class="text-dark text-decoration-none">{{ Str::limit($related->title, 50) }}</a></h4>
                            <div class="related-card-meta">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                    </rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ \Carbon\Carbon::parse($related->date)->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
