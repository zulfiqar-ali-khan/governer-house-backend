@extends('layouts.website')
@section('content')
    <!-- Contact Hero Section -->
    <section class="contact-hero-section text-center">
        <div class="container">
            <h1 class="contact-hero-title">Get in Touch</h1>
            <div class="contact-hero-divider mx-auto"></div>
            <p class="contact-hero-subtitle">
                Have questions about our initiatives or interested in partnering with us? Our<br>
                team is here to help.
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
                        <h3 class="contact-card-title">Contact Information</h3>

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
                                <span>1 Innovation Way<br>Global District<br>City Center, 10001</span>
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
                                <strong>Email Address</strong>
                                <span>contact@innovationagency.global</span>
                            </div>
                        </div>

                        <div class="contact-info-item border-0 pb-0">
                            <div class="contact-icon text-warning">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                            </div>
                            <div class="contact-text">
                                <strong>Phone Number</strong>
                                <span>+1 (800) 555-0199</span>
                            </div>
                        </div>
                    </div>

                    <!-- Global Offices Card -->
                    <div class="contact-card">
                        <h4 class="contact-offices-title">Global Offices</h4>
                        <ul class="contact-offices-list">
                            <li>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6c757d"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>
                                Europe Hub
                            </li>
                            <li>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6c757d"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>
                                Asia Hub
                            </li>
                            <li>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6c757d"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>
                                North America HQ
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Column (Form) -->
                <div class="col-lg-8">
                    <div class="contact-form-card">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Jane Doe" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Organization</label>
                                    <input type="text" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="jane@example.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="subject" placeholder="Enter subject" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" rows="5" placeholder="How can we help you?" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-contact-submit">Send Message</button>
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
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </section>
@endsection
