@extends('layouts.website')

@section('content')
    <!-- Contact Hero Section -->
    <section class="contact-hero-section text-center">
        <div class="container">
            <h1 class="contact-hero-title">Contact Governor House KP</h1>
            <div class="contact-hero-divider mx-auto"></div>
            <p class="contact-hero-subtitle">
                Governor's Secretariat, Khyber Pakhtunkhwa, Peshawar.<br>
                Official communications, public inquiries, and secretariat correspondence.
            </p>
        </div>
    </section>

    <!-- Contact Content Section -->
    <section class="contact-content-section py-5">
        <div class="container py-lg-4">
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-4">
                    <!-- Contact Info Card -->
                    <div class="contact-card mb-4">
                        <h3 class="contact-card-title">Secretariat Information</h3>

                        <div class="contact-info-item">
                            <div class="contact-icon text-warning">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <div class="contact-text">
                                <strong>Office Address</strong>
                                <span>Governor House Peshawar,<br>Aga Khan Road, Peshawar Cantt,<br>Khyber Pakhtunkhwa, Pakistan (25000)</span>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-icon text-warning">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <div class="contact-text">
                                <strong>Official Email Addresses</strong>
                                <span>governor@governor.kp.gov.pk</span>
                            </div>
                        </div>

                        {{-- <div class="contact-info-item border-0 pb-0">
                            <div class="contact-icon text-warning">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                            </div>
                            <div class="contact-text">
                                <strong>Telephone / Exchange</strong>
                                <span>+92 (91) 9211100 &ndash; 04<br>Fax: +92 (91) 9211105</span>
                            </div>
                        </div> --}}
                    </div>

                    <!-- Office Timings Card -->
                    <div class="contact-timings-card">
                        <h4 class="contact-timings-title">Official Timings</h4>
                        <div class="contact-timing-row">
                            <span>Monday &ndash; Friday</span>
                            <strong>09:00 AM &ndash; 05:00 PM</strong>
                        </div>
                        <div class="contact-timing-row">
                            <span>Saturday &ndash; Sunday</span>
                            <strong>Closed</strong>
                        </div>
                        <div class="contact-timing-row mb-0">
                            <span>Public Holidays</span>
                            <strong>Closed</strong>
                        </div>
                    </div>

                    <!-- Secretariat Wings Card -->
                    {{-- <div class="contact-card">
                        <h4 class="contact-offices-title">Secretariat Wings & Offices</h4>
                        <ul class="contact-offices-list">
                            <li>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6c757d"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-3" />
                                </svg>
                                Principal Secretariat to Governor
                            </li>
                            <li>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6c757d"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                </svg>
                                Military Secretary (MS) Wing
                            </li>
                            <li>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6c757d"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                </svg>
                                Public Grievances & Affairs Cell
                            </li>
                            <li>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6c757d"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                                    <line x1="8" y1="21" x2="16" y2="21" />
                                    <line x1="12" y1="17" x2="12" y2="21" />
                                </svg>
                                Media & Protocol Directorate
                            </li>
                            <li>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6c757d"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>
                                Governor House Retreat, Nathiagali
                            </li>
                        </ul>
                    </div> --}}
                </div>

                <!-- Right Column (Form) -->
                <div class="col-lg-8">
                    <div class="contact-form-card">
                        <div class="contact-ttg-notice">
                            <strong>Notice:</strong> For formal citizen petitions, suggestions, or proposals with tracking reference numbers, you can also submit directly through our official
                            <a href="{{ route('index') }}#talk-to-governor">Talk to Governor</a> portal.
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" placeholder="e.g. Muhammad Ali" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" placeholder="name@example.com" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="subject"
                                    value="{{ old('subject') }}" placeholder="e.g. Official inquiry, memorandum, public affair" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Message Content <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" rows="6"
                                    placeholder="Please provide details of your correspondence, inquiry or feedback..." required>{{ old('description') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-contact-submit">Send Official Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="contact-map-section">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d720.6234462037094!2d71.55625493773516!3d34.00935694739286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38d917c8a1749a11%3A0x55472cb3a3ac77cf!2sGovernor%20House%20Peshawar!5e0!3m2!1sen!2s!4v1791183933850!5m2!1sen!2s"
            width="600" height="450" allowfullscreen="" loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </section>
@endsection
