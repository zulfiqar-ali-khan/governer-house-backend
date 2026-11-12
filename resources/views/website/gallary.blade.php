@extends('layouts.website')

@section('content')
    <!-- The Governor's Engagements Gallery Section -->
    <section class="gov-engagement-section">
        <div class="container">
            <!-- Header Block -->
            <div class="gov-engagement-header">
                <div>
                    <span class="gov-engagement-badge">&mdash; PHOTO GALLERY</span>
                    <h1 class="gov-engagement-title">The Governor's Engagements</h1>
                    <p class="gov-engagement-desc">
                        Moments from the Governor's meetings, visits and ceremonies across Khyber Pakhtunkhwa and beyond.
                    </p>
                </div>
               
            </div>

           

            <!-- Gallery Grid -->
            <div class="row g-4" id="galleryGridContainer">
                @forelse ($galleries as $gallery)
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12 gallery-item-col"
                        data-category="{{ Str::slug($gallery->category ?? 'meetings') }}">
                        <div class="gov-engagement-card" data-bs-toggle="modal"
                            data-bs-target="#galleryModal{{ $gallery->id }}">
                            @if ($gallery->image && file_exists(public_path($gallery->image)))
                                <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}"
                                    class="gov-engagement-card-bg" loading="lazy">
                            @else
                                <div class="gov-engagement-camera-icon">
                                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.3" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                        <circle cx="12" cy="13" r="4"></circle>
                                    </svg>
                                </div>
                            @endif

                            <div class="gov-engagement-overlay">
                                <span class="gov-engagement-meta">
                                    @if (strtoupper($gallery->category ?? '') === 'HERITAGE')
                                        HERITAGE
                                    @elseif (!empty($gallery->created_at))
                                        {{ strtoupper($gallery->created_at->format('M Y')) }}
                                    @else
                                        {{ strtoupper($gallery->category ?? '2026') }}
                                    @endif
                                </span>
                                <h4 class="gov-engagement-card-title">{{ $gallery->title }}</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Lightbox Modal -->
                    <div class="modal fade" id="galleryModal{{ $gallery->id }}" tabindex="-1"
                        aria-labelledby="galleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered gallery-modal-dialog">
                            <div class="modal-content gallery-modal-content">
                                <!-- Floating Close Button -->
                                <button type="button" class="gallery-modal-floating-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>

                                <div class="modal-body gallery-modal-body">
                                    @if ($gallery->image && file_exists(public_path($gallery->image)))
                                        <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}"
                                            class="gallery-modal-img">
                                    @else
                                        <div class="py-5 text-center text-muted">
                                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                                <circle cx="12" cy="13" r="4"></circle>
                                            </svg>
                                            <p class="mt-3 text-light">Photo placeholder</p>
                                        </div>
                                    @endif

                                    <!-- Hover Caption: Hidden by default, reveals on hover -->
                                    <div class="gallery-modal-hover-overlay">
                                        <span class="gallery-modal-hover-meta">{{ strtoupper($gallery->category ?? 'GALLERY') }}</span>
                                        <h4 class="gallery-modal-hover-title" id="galleryModalLabel{{ $gallery->id }}">
                                            {{ $gallery->title }}
                                        </h4>
                                        @if ($gallery->description)
                                            <p class="gallery-modal-hover-desc">{{ $gallery->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No engagements found for this category.</p>
                    </div>
                @endforelse
            </div>

           

            <!-- Pagination if multiple pages -->
            @if ($galleries->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $galleries->appends(['category' => $category])->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pills = document.querySelectorAll('.gov-engagement-pill');
            const items = document.querySelectorAll('.gallery-item-col');

            pills.forEach(pill => {
                pill.addEventListener('click', function() {
                    pills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');

                    items.forEach(item => {
                        const itemCat = item.getAttribute('data-category');
                        if (filter === 'all' || itemCat === filter) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            const openFullBtn = document.getElementById('openFullGalleryBtn');
            if (openFullBtn) {
                openFullBtn.addEventListener('click', function(e) {
                    const allPill = document.querySelector('.gov-engagement-pill[data-filter="all"]');
                    if (allPill && !allPill.classList.contains('active')) {
                        e.preventDefault();
                        allPill.click();
                        allPill.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                });
            }

            // Click/tap toggle for lightbox modal overlay (especially for mobile/touch)
            document.querySelectorAll('.gallery-modal-body').forEach(body => {
                body.addEventListener('click', function(e) {
                    if (!e.target.closest('.gallery-modal-floating-close')) {
                        const content = this.closest('.gallery-modal-content');
                        if (content) {
                            content.classList.toggle('show-overlay');
                        }
                    }
                });
            });
        });
    </script>
@endsection
