@extends('layouts.website')
@section('content')
    <!-- Newsletter Detail Content -->
    <section class="news-detail-section">
        <div class="container">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb news-detail-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('index') }}#newsletters">Newsletters</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $newsletter->title }}</li>
                </ol>
            </nav>

            <span class="news-detail-tag">NEWSLETTER</span>
            <h1 class="news-detail-title">{{ $newsletter->title }}</h1>

            <!-- Meta Data -->
            <div class="news-detail-meta">
                <span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    {{ \Carbon\Carbon::parse($newsletter->date)->format('F d, Y') }}
                </span>
            </div>

            <!-- Featured Image -->
            <div class="news-detail-img-container">
                <img src="{{ asset($newsletter->thumnail_image) }}" alt="{{ $newsletter->title }}"
                    class="news-detail-img">
            </div>

            <!-- Content -->
            <div class="news-detail-content">
                {!! $newsletter->description !!}
            </div>


        </div>
    </section>
@endsection
