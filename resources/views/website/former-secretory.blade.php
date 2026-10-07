@extends('layouts.website')
@section('content')
    <!-- Former Governors Section -->
    <section class="former-gov-section py-5">
        <div class="container py-lg-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="former-gov-title">Former Secretaries</h2>
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
                        <img src="{{ asset($secretary->image) }}" alt="{{ $secretary->name }}" class="former-gov-img">
                        <h4 class="former-gov-name">{{ $secretary->name }}</h4>
                        <p class="former-gov-years">
                            {{ $secretary->from }} - {{ $secretary->is_present ? 'Present' : $secretary->to }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
