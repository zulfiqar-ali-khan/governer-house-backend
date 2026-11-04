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
                <div class="mt-3 mt-md-0">
                    <a href="{{ route('news-letter') }}" class="view-all-link">
                        View All &rarr;
                    </a>
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
            <div class="row g-4 align-items-stretch">
                <!-- Left: Information Card -->
                <div class="col-lg-4 col-md-12 d-flex">
                    <div class="gov-info-card w-100">
                        <div class="gov-accent-label">
                            <span class="gov-accent-dash">—</span> TALK TO THE GOVERNOR
                        </div>
                        <h2 class="gov-card-title">
                            Write directly to the<br>Office of the Governor
                        </h2>
                        <p class="gov-card-text">
                            Share your suggestions, proposals or concerns. Every submission is reviewed by the Governor's Secretariat and you receive a reference number for follow up.
                        </p>
                        <ul class="gov-feature-list">
                            <li>Attach a proposal or supporting document as PDF</li>
                            <li>Add up to three photos</li>
                            <li>Expect an acknowledgement by email</li>
                        </ul>
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="col-lg-8 col-md-12">
                    <div class="gov-form-wrapper">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <div class="d-flex align-items-start">
                                    <div class="me-2 mt-1">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <strong>Success!</strong> {{ session('success') }}
                                        @if(session('reference_number'))
                                            <div class="mt-2">
                                                <span class="fw-semibold">Your Tracking Reference Number:</span>
                                                <span class="badge bg-dark font-monospace text-white px-2 py-1 ms-1 font-size-13">{{ session('reference_number') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(isset($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <strong>Please check the following issues:</strong>
                                <ul class="mb-0 mt-1 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('talk-to-governor.store') }}" method="POST" enctype="multipart/form-data" class="gov-main-form" id="govContactForm">
                            @csrf

                            <!-- Row 1: Full Name & Email Address -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="govFullName" class="gov-form-label">Full Name</label>
                                    <input type="text" class="form-control gov-input" name="name" id="govFullName" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="govEmailAddress" class="gov-form-label">Email Address</label>
                                    <input type="email" class="form-control gov-input" name="email" id="govEmailAddress" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <!-- Row 2: Mobile Number & CNIC -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="govMobileNumber" class="gov-form-label">Mobile Number</label>
                                    <input type="text" class="form-control gov-input" name="mobile_number" id="govMobileNumber" placeholder="+92 3XX XXXXXXX" value="{{ old('mobile_number') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="govCnic" class="gov-form-label">CNIC <span class="optional-tag">(optional)</span></label>
                                    <input type="text" class="form-control gov-input" name="cnic" id="govCnic" placeholder="00000-0000000-0" value="{{ old('cnic') }}">
                                </div>
                            </div>

                            <!-- Row 3: District & Category -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="govDistrict" class="gov-form-label">District</label>
                                    <select class="form-select gov-input" name="district" id="govDistrict" required>
                                        <option value="" disabled {{ old('district') ? '' : 'selected' }}>Select district</option>
                                        @php
                                            $districts = [
                                                'Abbottabad', 'Bajaur', 'Bannu', 'Batagram', 'Buner', 'Charsadda',
                                                'Central Dir', 'Dera Ismail Khan', 'Hangu', 'Haripur', 'Karak',
                                                'Khyber', 'Kohat', 'Kolai-Palas', 'Kurram', 'Lakki Marwat',
                                                'Lower Chitral', 'Lower Dir', 'Lower Kohistan', 'Malakand',
                                                'Mansehra', 'Mardan', 'Mohmand', 'North Waziristan', 'Nowshera',
                                                'Orakzai', 'Peshawar', 'Shangla', 'South Waziristan Lower',
                                                'South Waziristan Upper', 'Swabi', 'Swat', 'Tank', 'Torghar',
                                                'Upper Chitral', 'Upper Dir', 'Upper Kohistan', 'Other'
                                            ];
                                        @endphp
                                        @foreach($districts as $d)
                                            <option value="{{ $d }}" {{ old('district') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="govCategory" class="gov-form-label">Category</label>
                                    <select class="form-select gov-input" name="category" id="govCategory" required>
                                        <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select category</option>
                                        @php
                                            $categories = [
                                                'General Suggestion / Proposal',
                                                'Public Grievance / Complaint',
                                                'Education & Higher Education',
                                                'Healthcare & Medical Relief',
                                                'Youth Affairs & Sports',
                                                'Information Technology & Innovation',
                                                'Infrastructure & Public Works',
                                                'Law, Justice & Human Rights',
                                                'Culture, Tourism & Heritage',
                                                'Agriculture & Livestock',
                                                'Other'
                                            ];
                                        @endphp
                                        @foreach($categories as $c)
                                            <option value="{{ $c }}" {{ old('category') == $c ? 'selected' : '' }}>{{ $c }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Row 4: Subject -->
                            <div class="mb-3">
                                <label for="govSubject" class="gov-form-label">Subject</label>
                                <input type="text" class="form-control gov-input" name="subject" id="govSubject" value="{{ old('subject') }}" required>
                            </div>

                            <!-- Row 5: Message -->
                            <div class="mb-3">
                                <label for="govMessage" class="gov-form-label">Message</label>
                                <textarea class="form-control gov-input" name="message" id="govMessage" rows="5" maxlength="2000" required>{{ old('message') }}</textarea>
                                <div class="gov-char-count text-muted">
                                    <span id="govCharCounter">0</span> / 2000
                                </div>
                            </div>

                            <!-- Row 6: Attachments (PDF & Images) -->
                            <div class="row g-3 mb-3">
                                <!-- PDF Document Upload -->
                                <div class="col-md-6">
                                    <label class="gov-form-label">Attach Document <span class="optional-tag">(PDF, optional)</span></label>
                                    <input type="file" name="document" id="govDocumentInput" accept=".pdf" class="d-none">
                                    <div class="gov-upload-card" id="govDocUploadCard">
                                        <div class="gov-upload-icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                        </div>
                                        <div class="gov-upload-text">
                                            <div class="gov-upload-title" id="govDocTitle">Choose a PDF or drop it here</div>
                                            <div class="gov-upload-sub" id="govDocSub">One file, up to 10 MB</div>
                                        </div>
                                        <button type="button" class="btn-close d-none font-size-11" id="govDocClear" aria-label="Clear document"></button>
                                    </div>
                                </div>

                                <!-- Images Upload -->
                                <div class="col-md-6">
                                    <label class="gov-form-label">Attach Images <span class="optional-tag">(optional)</span></label>
                                    <input type="file" name="images[]" id="govImagesInput" accept="image/jpeg,image/png,image/jpg" multiple class="d-none">
                                    <div class="gov-upload-card" id="govImagesUploadCard">
                                        <div class="gov-upload-icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                <polyline points="21 15 16 10 5 21"></polyline>
                                            </svg>
                                        </div>
                                        <div class="gov-upload-text">
                                            <div class="gov-upload-title" id="govImagesTitle">Choose images or drop them here</div>
                                            <div class="gov-upload-sub" id="govImagesSub">Up to 3 files, JPG or PNG, 5 MB each</div>
                                        </div>
                                        <button type="button" class="btn-close d-none font-size-11" id="govImagesClear" aria-label="Clear images"></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Row 7: Consent Checkbox -->
                            <div class="gov-consent-box mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="consent" id="govConsentCheck" value="1" required>
                                    <label class="form-check-label" for="govConsentCheck">
                                        I confirm that the information provided is accurate and I consent to the Governor's Secretariat using it to process my submission.
                                    </label>
                                </div>
                            </div>

                            <!-- Row 8: Footer (Captcha Info & Submit Button) -->
                            <div class="gov-form-footer">
                                <button type="submit" class="btn btn-gov-submit">
                                    Submit Message
                                </button>
                            </div>
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
