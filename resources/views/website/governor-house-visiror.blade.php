@extends('layouts.website')
@section('content')
    <!-- Governor House Visitors Section -->
    <section class="former-gov-section py-5">
        <div class="container py-lg-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="former-gov-title">Governor House Visitors</h2>
                    <p class="former-gov-desc">
                        Honoring the distinguished dignitaries, foreign delegations, and esteemed guests who have visited the Governor House Khyber Pakhtunkhwa.
                    </p>
                    <div class="former-gov-divider mx-auto"></div>
                </div>
            </div>

            <div class="row g-4">
                @forelse($visitors as $visitor)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="former-gov-card text-center d-flex flex-column align-items-center">
                        @if($visitor->image)
                            <img src="{{ asset($visitor->image) }}" alt="{{ $visitor->name }}" class="former-gov-img">
                        @else
                            <div class="former-gov-img d-inline-flex align-items-center justify-content-center bg-light text-muted border mx-auto">
                                <i class="fas fa-user-tie fa-3x"></i>
                            </div>
                        @endif
                        <h4 class="former-gov-name mb-1">{{ $visitor->name }}</h4>
                        @if($visitor->description)
                            <p class="text-muted small mb-2">{{ $visitor->description }}</p>
                        @endif
                        @if($visitor->date)
                            <p class="former-gov-years mt-auto">
                                <i class="far fa-calendar-alt me-1 text-warning"></i>
                                {{ \Carbon\Carbon::parse($visitor->date)->format('F d, Y') }}
                            </p>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No visitors found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
