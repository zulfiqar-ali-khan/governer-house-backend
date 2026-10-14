@extends('layouts.website')
@section('content')
    <!-- Former Governors Section -->
    <section class="former-gov-section py-5">
        <div class="container py-lg-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="former-gov-title">Governor's Secretariat</h2>
                    <p class="former-gov-desc">
                        Honoring the visionary leaders who have guided the Global Innovation Agency through decades of
                        transformative impact. Their strategic oversight and dedication have shaped our institutional legacy
                        and global footprint.
                    </p>
                    <div class="former-gov-divider mx-auto"></div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($secretaries as $secretary)
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
                        <p class="former-gov-position">
                           {{ $secretary->position }}
                        </p>
                        <a href="tel:{{ $secretary->phone }}" class="former-gov-phone">
                            Office: {{ $secretary->phone }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
