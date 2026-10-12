@extends('layouts.website')
@section('content')
    <!-- banner section -->
    <section class="banner-section">
        <div class="banner-slider">
            @foreach($sliders as $slider)
            <div class="slide-item" style="background-image: url('{{ asset($slider->image) }}');">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-8 text-start">
                                @if($slider->label)
                                <div class="slide-badge">
                                    <span class="badge-icon">❖</span> {{ $slider->label }}
                                </div>
                                @endif
                                @if($slider->title)
                                <h1 class="slide-title">{!! nl2br(e($slider->title)) !!}</h1>
                                <div class="slide-divider"></div>
                                @endif
                                @if($slider->description)
                                <p class="slide-description">
                                    {{ $slider->description }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- ./ banner Section -->

    <!-- video section -->


    <!-- MD Message section -->
    @if($governorMessage)
    <section class="md-message-section py-5">
        <div class="container py-lg-4">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6 mb-5 mb-md-0">
                    <div class="director-image-container">
                        <div class="director-yellow-bg"></div>
                        <img class="director-img" src="{{ asset($governorMessage?->image) }}" alt="{{ $governorMessage->name }}">
                        <div class="director-circle-decor"></div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 ps-lg-5">
                    <div class="director-message-content">
                        <h2 class="director-title">{{ $governorMessage->title }}</h2>
                        <div class="director-divider"></div>
                        <p class="director-quote">
                            "{{ $governorMessage->short_description }}"
                        </p>
                        <div class="director-info">
                            <h4 class="director-name">{{ $governorMessage->name }}</h4>
                            <p class="director-role">{{ $governorMessage->designation }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--  ./ MD Message section -->

    <!-- Impact section -->
    <section class="impact-section py-5">
        <div class="container text-center text-white">
            <h2 class="impact-section-title">Our Global Impact</h2>
            <div class="row g-4">
                @foreach($impacts as $impact)
                <div class="col-lg-3 col-sm-6">
                    <div class="stat-card">
                        <h3 class="stat-number">{{ $impact->heading }}</h3>
                        <p class="stat-label">{{ $impact->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ./ Impact section -->
    <!-- Newsletters section -->
    <section class="newsletters-section pt-5 pb-5 position-relative">
        <!-- Optional dotted background left side -->
        <div class="newsletter-dots-bg position-absolute" style="left: 0; bottom: 20%; width: 100px; height: 200px; background-image: radial-gradient(#d3d3d3 1.5px, transparent 1.5px); background-size: 15px 15px; opacity: 0.6; z-index: 0;"></div>
        
        <div class="container py-lg-4 position-relative z-1">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="me-2" style="width: 30px; height: 2px; background-color: var(--yellow); display: inline-block;"></span>
                        <span style="font-size: 12px; font-weight: 700; color: #5a7d7c; letter-spacing: 2px;">NEWSLETTER</span>
                    </div>
                    <h2 class="mb-2 fw-bolder text-dark" style="font-size: 40px; letter-spacing: -0.5px;">Our Latest & <span style="color: var(--yellow);">Upcoming Newsletters</span></h2>
                    <p class="mb-0 text-start" style="font-size: 16px; color: #6c757d; max-width: 500px; line-height: 1.6;">
                        Explore our newsletters to stay informed about our latest initiatives, success stories, events and opportunities.
                    </p>
                </div>
              
            </div>

            <div class="row g-4">
                @if($newsLetters->count() > 0)
                <!-- Left: Current Newsletter -->
                <div class="col-lg-7">
                    @php $featuredNewsletter = $newsLetters->first(); @endphp
                    <div class="bg-white rounded p-4 h-100 position-relative shadow-sm border-0 mt-4" style="z-index: 2;">
                        
                        <div class="row g-0 h-100 mt-4">
                            <!-- Image Column -->
                            <div class="col-md-5 position-relative pt-2 pe-md-3">
                                <!-- Dark Green & Yellow background decorative elements -->
                                <div class="position-absolute rounded-3" style="background-color: var(--dark-green); width: 85%; height: 95%; top: -10px; left: -15px; z-index: 0;"></div>
                                <div class="position-absolute rounded-3" style="background-color: var(--yellow); width: 90%; height: 85%; top: 10px; right: 0; z-index: 0;border-radius: 20px;overflow: hidden;">
                                    <img src="{{ asset($featuredNewsletter->thumnail_image) }}" class="w-100 h-100" alt="{{ $featuredNewsletter->title }}" style="object-fit: cover;">
                                </div>
                            </div>

                            <!-- Content Column -->
                            <div class="col-md-7 ps-md-4 mt-4 mt-md-0 z-1 d-flex flex-column justify-content-center">
                                <span class="d-block fw-bold mb-2" style="letter-spacing: 2px; font-size: 11px; color: #5a7d7c; text-transform: uppercase;">{{ \Carbon\Carbon::parse($featuredNewsletter->date)->format('F Y') }}</span>
                                <h3 class="text-dark fw-bolder mb-3" style="font-size: 24px; line-height: 1.3;">{{ $featuredNewsletter->title }}</h3>
                                <p class="mb-4" style="color: #6c757d; font-size: 14px; line-height: 1.6;">
                                    {{ Str::limit(strip_tags($featuredNewsletter->description), 150) }}
                                </p>
                                <div>
                                    <a href="{{ route('news-letter-detail', ['slug' => $featuredNewsletter->slug]) }}" class="read-more-link">Read More <span class="arrow">→</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Upcoming Newsletters -->
                <div class="col-lg-5 pt-3 pt-lg-0">
                    <div class="mb-4 d-flex align-items-center">
                        <i class="far fa-calendar-alt me-2" style="font-size: 28px; color: var(--dark-green);"></i>
                        <div>
                            <h4 class="mb-0 fw-bolder text-dark" style="font-size: 20px;">Other Newsletters</h4>
                            <small style="color: #6c757d; font-size: 14px;">Explore our previous editions.</small>
                        </div>
                    </div>
                    
                    <div class="upcoming-list d-flex flex-column gap-3">
                        @foreach($newsLetters->skip(1) as $newsletter)
                        <!-- Upcoming Item -->
                        <div class="bg-white p-3 rounded mb-0 border shadow-sm transition-all d-flex align-items-center justify-content-between" style="border-color: #f1f1f1 !important;">
                            <div class="d-flex align-items-center flex-grow-1">
                                <div class="me-3">
                                    <img src="{{ asset($newsletter->thumnail_image) }}" alt="{{ $newsletter->title }}" class="rounded" style="width: 75px; height: 75px; object-fit: cover;">
                                </div>
                                <div class="pe-2">
                                    <span class="d-block fw-bold mb-1" style="font-size: 10px; letter-spacing: 1px; color: #5a7d7c; text-transform: uppercase;">{{ \Carbon\Carbon::parse($newsletter->date)->format('F Y') }}</span>
                                    <h5 class="fw-bolder mb-1 text-dark" style="font-size: 15px;"><a href="{{ route('news-letter-detail', ['slug' => $newsletter->slug]) }}" class="text-dark text-decoration-none">{{ $newsletter->title }}</a></h5>
                                    <p class="mb-0 text-muted" style="font-size: 12px; line-height: 1.4;">{{ Str::limit(strip_tags($newsletter->description), 50) }}</p>
                                </div>
                            </div>
                            <div class="text-center rounded px-2 py-2" style="background-color: #fef8e6; color: var(--dark-green); min-width: 55px;">
                                <div class="fw-bolder" style="font-size: 20px; line-height: 1;">{{ \Carbon\Carbon::parse($newsletter->date)->format('d') }}</div>
                                <div class="fw-bold mt-1" style="font-size: 10px;">{{ strtoupper(\Carbon\Carbon::parse($newsletter->date)->format('M')) }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="col-12">
                    <p>No newsletters available at the moment.</p>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- ./ Newsletters section -->

    <!-- Initiatives section -->
    <section class="initiatives-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Key Initiatives</h2>
                <p class="section-subtitle">
                    Focusing our resources on areas with the highest potential for transformative impact.
                </p>
            </div>
            <div class="row g-4">
                @foreach($initiatives as $initiative)
                <div class="col-lg-4 col-md-6">
                    <div class="initiative-card">
                        <div class="initiative-icon">
                            {!! $initiative->icon !!}
                        </div>
                        <div class="initiative-content">
                            <h3 class="initiative-title">{{ $initiative->heading }}</h3>
                            <p class="initiative-desc">{{ $initiative->description }}</p>
                            @if($initiative->link)
                            <a href="{{ $initiative->link }}" class="initiative-link">Learn More <span class="arrow">→</span></a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ./ Initiatives section -->

    <!-- talk to governer -->
    <section class="talk-to-gov-section py-5">
        <div class="container py-lg-4">
            <div class="row align-items-center">
                <!-- Left: Governor Image -->
                <div class="col-lg-5 col-md-6 mb-5 mb-md-0">
                    <div class="gov-img-wrapper">
                        <img src="{{ asset($governorMessage->image) }}" alt="{{ $governorMessage->name }}" class="gov-form-img">
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="col-lg-7 col-md-6 ps-lg-5">
                    <div class="gov-form-container">
                        <h2 class="form-section-title">Talk to Governor</h2>
                        <p class="form-section-subtitle">
                            Have a vision for innovation or a strategic proposal? Connect directly with our
                            leadership to discuss how we can shape the future together.
                        </p>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('talk-to-governor.store') }}" method="POST" class="gov-contact-form">
                            @csrf
                            <div class="mb-4">
                                <label for="govName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" id="govName" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-4">
                                <label for="govEmail" class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" id="govEmail" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-4">
                                <label for="govMessage" class="form-label">Message</label>
                                <textarea class="form-control" name="message" id="govMessage" rows="4" placeholder="How can we collaborate?" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-submit-yellow">Submit Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  ./talk to governer -->


    <!-- Events and News Section  -->
    <section class="event-news-section py-5">
        <div class="container py-lg-4">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="section-title mb-0">Latest News & Events</h2>
                <a href="{{ route('news') }}" class="view-all-link">View All <span class="arrow">→</span></a>
            </div>
            <div class="row g-4">
                @if($newsAndEvents->count() > 0)
                <!-- Left: Featured news (col-lg-7) -->
                <div class="col-lg-7">
                    @php $featured = $newsAndEvents->first(); @endphp
                    <div class="featured-card">
                        <div class="featured-img-wrapper">
                            <img src="{{ asset($featured->thumnail_image) }}" class="featured-img" alt="{{ $featured->title }}">
                        </div>
                        <div class="featured-body">
                            <span class="news-date">{{ \Carbon\Carbon::parse($featured->date)->format('F d, Y') }}</span>
                            <h3 class="featured-title"><a href="{{ route('news-detail', ['slug' => $featured->slug]) }}" class="text-dark text-decoration-none">{{ $featured->title }}</a></h3>
                            <p class="featured-text">{{ Str::limit(strip_tags($featured->description), 150) }}</p>
                            <a href="{{ route('news-detail', ['slug' => $featured->slug]) }}" class="read-more-link">Read More <span class="arrow">→</span></a>
                        </div>
                    </div>
                </div>

                <!-- Right: Small news items list (col-lg-5) -->
                <div class="col-lg-5">
                    <div class="news-list">
                        @foreach($newsAndEvents->skip(1) as $item)
                        <!-- News item -->
                        <div class="news-item">
                            <div class="row g-3 align-items-center">
                                <div class="col-4">
                                    <div class="item-img-wrapper">
                                        <img src="{{ asset($item->thumnail_image) }}" class="item-img"
                                            alt="{{ $item->title }}">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="item-body">
                                        <span class="news-date">{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</span>
                                        <h4 class="item-title"><a href="{{ route('news-detail', ['slug' => $item->slug]) }}" class="text-dark text-decoration-none">{{ $item->title }}</a></h4>
                                        <a href="{{ route('news-detail', ['slug' => $item->slug]) }}" class="read-more-link-simple">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="col-12">
                    <p>No news or events available at the moment.</p>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- ./ Events and News Section -->
@endsection
