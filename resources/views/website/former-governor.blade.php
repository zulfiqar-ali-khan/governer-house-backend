@extends('layouts.website')
@section('content')
    <!-- Former Governors Section -->
    <section class="former-gov-section py-5">
        <div class="container py-lg-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="former-gov-title">Former Governors</h2>
                    <p class="former-gov-desc">
                        Honoring the visionary leaders who have guided the Global Innovation Agency through decades of
                        transformative impact. Their strategic oversight and dedication have shaped our institutional legacy
                        and global footprint.
                    </p>
                    <div class="former-gov-divider mx-auto"></div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($governors as $governor)
                @if($governor->is_present == 0)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="former-gov-card text-center">
                        @if($governor->image)
                            <img src="{{ asset($governor->image) }}" alt="{{ $governor->name }}" class="former-gov-img">
                        @else
                            <div class="former-gov-img d-inline-flex align-items-center justify-content-center bg-light text-muted border mx-auto">
                                <i class="fas fa-user-tie fa-3x"></i>
                            </div>
                        @endif
                        <h4 class="former-gov-name">{{ $governor->name }}</h4>
                        <p class="former-gov-years">
                            {{ \Carbon\Carbon::parse($governor->from)->format('Y') }} - {{ $governor->is_present ? 'Present' : ($governor->to ? \Carbon\Carbon::parse($governor->to)->format('Y') : '') }}
                        </p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
