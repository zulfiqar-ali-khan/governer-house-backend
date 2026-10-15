@extends('layouts.website')
@section('content')
    <!-- Newsletter Detail Content -->
    <section class="news-detail-section">
        <div class="container">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb news-detail-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news-letter') }}">Newsletters</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $newsletter->title }}</li>
                </ol>
            </nav>

            <span class="news-detail-tag">NEWSLETTER</span>
            <h1 class="news-detail-title">{{ $newsletter->title }}</h1>

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
                    {{ \Carbon\Carbon::parse($newsletter->date)->format('F d, Y') }}
                </span>
            </div>

            <!-- Featured Image -->
            <div class="news-detail-img-container">
                <img src="{{ asset($newsletter->thumnail_image) }}" alt="{{ $newsletter->title }}"
                    class="news-detail-img">
            </div>

            <!-- Content -->
            <div class="news-detail-content">
                {!! $newsletter->description !!}
            </div>


        </div>
    </section>

    @if(isset($relatedNewsletters) && $relatedNewsletters->count() > 0)
    <!-- Related Newsletters Section -->
    <section class="related-news-section pb-5">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="related-news-title mb-0">Other Newsletters</h2>
                <a href="{{ route('news-letter') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">View All Newsletters &rarr;</a>
            </div>
            <div class="row g-4 mt-2">
                @foreach($relatedNewsletters as $related)
                <div class="col-lg-4 col-md-6">
                    <div class="related-card">
                        <img src="{{ asset($related->thumnail_image) }}" class="related-card-img" alt="{{ $related->title }}">
                        <div class="related-card-body">
                            <span class="related-card-tag tag-yellow">NEWSLETTER</span>
                            <h4 class="related-card-title"><a href="{{ route('news-letter-detail', ['slug' => $related->slug]) }}" class="text-dark text-decoration-none">{{ Str::limit($related->title, 50) }}</a></h4>
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
    @endif
@endsection
