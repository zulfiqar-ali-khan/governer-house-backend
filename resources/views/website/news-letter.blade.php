@extends('layouts.website')
@section('content')
    <!-- Newsletter Hero Section -->
    <section class="news-hero-section">
        <div class="news-hero-overlay"></div>
        <div class="container text-center position-relative" style="z-index: 2;">
            <div class="d-inline-flex align-items-center gap-2 mb-2 px-3 py-1 rounded-pill"
                style="background: rgba(254, 203, 0, 0.15); border: 1px solid rgba(254, 203, 0, 0.4);">
                <span style="width: 8px; height: 8px; background-color: var(--yellow); border-radius: 50%; display: inline-block;"></span>
                <span style="font-size: 13px; font-weight: 700; color: var(--yellow); letter-spacing: 1.5px; text-transform: uppercase;">Official Publications</span>
            </div>
            <h1 class="news-hero-title">Governor House Newsletters</h1>
            <p class="news-hero-subtitle">
                Stay updated with official monthly releases, institutional highlights, and key announcements from the Governor House Khyber Pakhtunkhwa.
            </p>
        </div>
    </section>

    <!-- Newsletters Content Section -->
    <section class="news-content-section py-5">
        <div class="container py-4">

            <!-- Month Filter Navigation Bar -->
            <div class="newsletter-filter-bar mb-5">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="fw-bold me-2 text-dark d-flex align-items-center gap-1" style="font-size: 14px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            Filter by Month:
                        </span>
                        <a href="{{ route('news-letter') }}"
                            class="newsletter-filter-tab {{ empty($selectedMonth) || $selectedMonth === 'all' ? 'active' : '' }}">
                            All Newsletters
                            <span class="badge-count">{{ $totalCount }}</span>
                        </a>
                        @foreach ($availableMonths as $month)
                            <a href="{{ route('news-letter', ['month' => $month->month_key]) }}"
                                class="newsletter-filter-tab {{ $selectedMonth === $month->month_key ? 'active' : '' }}">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ $month->month_label }}
                                <span class="badge-count">{{ $month->count }}</span>
                            </a>
                        @endforeach
                    </div>

                    @if (!empty($selectedMonth) && $selectedMonth !== 'all')
                        <a href="{{ route('news-letter') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 d-inline-flex align-items-center gap-1">
                            <span>&times;</span> Clear Filter
                        </a>
                    @endif
                </div>

                @if (!empty($selectedMonthLabel))
                    <div class="mt-3 pt-3 border-top d-flex align-items-center justify-content-between">
                        <span class="text-muted small">
                            Showing newsletters published in <strong class="text-dark">{{ $selectedMonthLabel }}</strong> ({{ $allNewsletters->count() }} found)
                        </span>
                        <a href="{{ route('news-letter') }}" class="text-decoration-none small text-success fw-bold">
                            View All Months &rarr;
                        </a>
                    </div>
                @endif
            </div>

            @if ($allNewsletters->count() > 0)
                {{-- Featured Card: Highlight the latest / top newsletter --}}
                @if (isset($featuredNewsletter))
                    <div class="news-featured-card mb-5">
                        <div class="row g-0 align-items-center">
                            <div class="col-lg-5">
                                <div class="position-relative overflow-hidden h-100">
                                    <img src="{{ asset($featuredNewsletter->thumnail_image) }}" class="news-featured-img w-100"
                                        alt="{{ $featuredNewsletter->title }}" style="max-height: 420px; object-fit: cover;">
                                    <span class="card-date-badge">
                                        <span class="day">{{ \Carbon\Carbon::parse($featuredNewsletter->date)->format('d') }}</span>
                                        <span class="mon">{{ strtoupper(\Carbon\Carbon::parse($featuredNewsletter->date)->format('M')) }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="news-featured-body">
                                    <div class="news-meta mb-3">
                                        <span class="news-tag text-uppercase fw-bold">LATEST NEWSLETTER</span>
                                        <span class="news-date text-muted ms-3">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($featuredNewsletter->date)->format('F d, Y') }}
                                        </span>
                                    </div>
                                    <h2 class="news-featured-title">
                                        <a href="{{ route('news-letter-detail', ['slug' => $featuredNewsletter->slug]) }}"
                                            class="text-dark text-decoration-none">
                                            {{ $featuredNewsletter->title }}
                                        </a>
                                    </h2>
                                    <p class="news-featured-desc">
                                        {{ Str::limit(strip_tags($featuredNewsletter->description), 220) }}
                                    </p>
                                    <div>
                                        <a href="{{ route('news-letter-detail', ['slug' => $featuredNewsletter->slug]) }}"
                                            class="news-read-more">
                                            Read Full Newsletter &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Month-Wise Sections --}}
                @foreach ($groupedNewsletters as $monthYear => $items)
                    <div class="month-newsletter-group mb-5" id="month-{{ Str::slug($monthYear) }}">
                        <div class="month-section-header d-flex flex-wrap align-items-center justify-content-between mb-4 pb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="month-header-icon shadow-sm">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="month-section-title mb-0">{{ $monthYear }}</h3>
                                    <small class="text-muted">{{ $items->count() }} {{ Str::plural('Newsletter', $items->count()) }} Published</small>
                                </div>
                            </div>
                            <span class="month-edition-badge">
                                {{ $monthYear }} Edition
                            </span>
                        </div>

                        <!-- Grid Cards for this month -->
                        <div class="row g-4">
                            @foreach ($items as $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="news-grid-card newsletter-card-hover shadow-sm">
                                        <div class="position-relative overflow-hidden">
                                            <img src="{{ asset($item->thumnail_image) }}" class="news-grid-img"
                                                alt="{{ $item->title }}">
                                            <span class="card-date-badge">
                                                <span class="day">{{ \Carbon\Carbon::parse($item->date)->format('d') }}</span>
                                                <span class="mon">{{ strtoupper(\Carbon\Carbon::parse($item->date)->format('M')) }}</span>
                                            </span>
                                        </div>
                                        <div class="news-grid-body">
                                            <div class="news-meta mb-3">
                                                <span class="news-grid-tag tag-dark">NEWSLETTER</span>
                                                <span class="news-date text-muted ms-2">
                                                    {{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}
                                                </span>
                                            </div>
                                            <h4 class="news-grid-title">
                                                <a href="{{ route('news-letter-detail', ['slug' => $item->slug]) }}"
                                                    class="text-dark text-decoration-none">
                                                    {{ $item->title }}
                                                </a>
                                            </h4>
                                            <p class="news-grid-desc">
                                                {{ Str::limit(strip_tags($item->description), 120) }}
                                            </p>
                                            <a href="{{ route('news-letter-detail', ['slug' => $item->slug]) }}"
                                                class="news-read-more mt-auto">
                                                Read Newsletter &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            @else
                <!-- Empty State -->
                <div class="text-center py-5 bg-white rounded-4 shadow-sm p-5 my-4">
                    <div class="mb-3 text-muted">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-secondary opacity-50">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">No Newsletters Found</h4>
                    <p class="text-muted mb-4">
                        @if (!empty($selectedMonthLabel))
                            There are currently no newsletters available for <strong>{{ $selectedMonthLabel }}</strong>.
                        @else
                            No newsletters are currently published. Please check back soon.
                        @endif
                    </p>
                    <a href="{{ route('news-letter') }}" class="btn btn-outline-dark rounded-pill px-4">
                        View All Newsletters
                    </a>
                </div>
            @endif

        </div>
    </section>
@endsection
