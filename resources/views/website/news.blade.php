@extends('layouts.website')
@section('content')
    <!-- New Page Content -->
    <section class="news-hero-section">
        <div class="news-hero-overlay"></div>
        <div class="container text-center position-relative" style="z-index: 2;">
            <h1 class="news-hero-title">News & Events</h1>
            <p class="news-hero-subtitle">
                Stay updated with the latest breakthroughs, strategic partnerships, and<br>
                upcoming initiatives from the Global Innovation Agency.
            </p>
        </div>
    </section>

    <section class="news-content-section py-5">
        <div class="container py-4">
            @if($newsAndEvents->count() > 0)
                @php $featured = $newsAndEvents->first(); @endphp
                <!-- Featured Card -->
                <div class="news-featured-card mb-5">
                    <div class="row g-0">
                        <div class="col-lg-4">
                            <img src="{{ asset($featured->thumnail_image) }}" class="news-featured-img" alt="{{ $featured->title }}">
                        </div>
                        <div class="col-lg-6">
                            <div class="news-featured-body">
                                <div class="news-meta mb-3">
                                    <span class="news-tag text-uppercase fw-bold">{{ $featured->type }}</span>
                                    <span class="news-date text-muted ms-3">{{ \Carbon\Carbon::parse($featured->date)->format('F d, Y') }}</span>
                                </div>
                                <h2 class="news-featured-title"><a href="{{ route('news-detail', ['slug' => $featured->slug]) }}" class="text-dark text-decoration-none">{{ $featured->title }}</a></h2>
                                <p class="news-featured-desc">
                                    {{ Str::limit(strip_tags($featured->description), 200) }}
                                </p>
                                <a href="{{ route('news-detail', ['slug' => $featured->slug]) }}" class="news-read-more">Read Full Release &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid -->
                <div class="row g-4 mb-5">
                    @foreach($newsAndEvents->skip(1) as $item)
                    <!-- Card -->
                    <div class="col-lg-4 col-md-6">
                        <div class="news-grid-card">
                            <img src="{{ asset($item->thumnail_image) }}" class="news-grid-img" alt="{{ $item->title }}">
                            <div class="news-grid-body">
                                <div class="news-meta mb-3">
                                    <span class="news-grid-tag">{{ strtoupper($item->type) }}</span>
                                    <span class="news-date text-muted ms-2">{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</span>
                                </div>
                                <h4 class="news-grid-title"><a href="{{ route('news-detail', ['slug' => $item->slug]) }}" class="text-dark text-decoration-none">{{ $item->title }}</a></h4>
                                <p class="news-grid-desc">{{ Str::limit(strip_tags($item->description), 120) }}</p>
                                <a href="{{ route('news-detail', ['slug' => $item->slug]) }}" class="news-read-more">Read More &rarr;</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $newsAndEvents->links() }}
                </div>
            @else
                <div class="text-center">
                    <p>No news or events found.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
