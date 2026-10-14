@extends('layouts.website')
@section('content')
    <!-- Principal Secretaries Section -->
    <section class="former-gov-section py-5">
        <div class="container py-lg-4">
            @php
                $currentSecretary = $secretaries->where('is_present', 1)->first();
            @endphp

            @if($currentSecretary)
                <!-- Current Office Holder Banner -->
                <div class="current-officer-banner">
                    <div class="current-officer-photo-wrapper">
                        @if($currentSecretary->image)
                            <img src="{{ asset($currentSecretary->image) }}" alt="{{ $currentSecretary->name }}" class="current-officer-img">
                        @else
                            <img src="{{ asset('default.jpeg') }}" alt="{{ $currentSecretary->name }}" class="current-officer-img">
                        @endif
                    </div>
                    <div class="current-officer-details">
                        <span class="current-officer-badge">CURRENT Principal Secretaries</span>
                        <h2 class="current-officer-name">{{ $currentSecretary->name }}</h2>
                        <p class="current-officer-position">{{ $currentSecretary->position ?? 'Principal Secretary to Hon\'ble Governor Khyber Pakhtunkhwa' }}</p>

                        @if($currentSecretary->phone || $currentSecretary->fax || $currentSecretary->intercom)
                            <div class="current-officer-contact-grid">
                                @if($currentSecretary->phone)
                                    <div class="current-officer-contact-box">
                                        <div class="contact-box-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.46.57 3.58a1 1 0 01-.24 1.01l-2.21 2.2z"/>
                                            </svg>
                                        </div>
                                        <div class="contact-box-content">
                                            <span class="contact-box-label">PHONE</span>
                                            <span class="contact-box-val">{{ $currentSecretary->phone }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if($currentSecretary->fax)
                                    <div class="current-officer-contact-box">
                                        <div class="contact-box-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M19 8h-1V3H6v5H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zM8 5h8v3H8V5zm8 14H8v-4h8v4zm2-4v-2H6v2H4v-4c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v4h-2zm1-3.5c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/>
                                            </svg>
                                        </div>
                                        <div class="contact-box-content">
                                            <span class="contact-box-label">FAX</span>
                                            <span class="contact-box-val">{{ $currentSecretary->fax }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if($currentSecretary->intercom)
                                    <div class="current-officer-contact-box contact-box-wide">
                                        <div class="contact-box-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-9 3h4v2h-4V5zm-2 5h2v2H8v-2zm0 3h2v2H8v-2zm0 3h2v2H8v-2zm3-6h2v2h-2v-2zm0 3h2v2h-2v-2zm0 3h2v2h-2v-2zm3-6h2v2h-2v-2zm0 3h2v2h-2v-2zm0 3h2v2h-2v-2z"/>
                                            </svg>
                                        </div>
                                        <div class="contact-box-content">
                                            <span class="contact-box-label">INTERCOM</span>
                                            <span class="contact-box-val">{{ $currentSecretary->intercom }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="row justify-content-center mb-5 {{ $currentSecretary ? 'mt-4' : '' }}">
                <div class="col-lg-8 text-center">
                    <h2 class="former-gov-title">Former Principal Secretaries</h2>
                    <p class="former-gov-desc">
                        Honoring the visionary leaders who have guided the Governor's Secretariat through decades of
                        transformative impact. Their strategic oversight and dedication have shaped our institutional legacy
                        and global footprint.
                    </p>
                    <div class="former-gov-divider mx-auto"></div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($secretaries as $secretary)
                    @if(!$secretary->is_present)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="former-gov-card text-center">
                                @if($secretary->image)
                                    <img src="{{ asset($secretary->image) }}" alt="{{ $secretary->name }}" class="former-gov-img">
                                @else
                                    <div class="former-gov-img d-inline-flex align-items-center justify-content-center bg-light text-muted border mx-auto">
                                        <img src="{{ asset('default.jpeg') }}" alt="Secretary" class="former-gov-img">
                                    </div>
                                @endif
                                <h4 class="former-gov-name">{{ $secretary->name }}</h4>
                                <p class="former-gov-years">
                                    {{ $secretary->from ? date('M, Y', strtotime($secretary->from)) : '' }} &nbsp; To &nbsp; {{ $secretary->to ? date('M, Y', strtotime($secretary->to)) : '' }}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
