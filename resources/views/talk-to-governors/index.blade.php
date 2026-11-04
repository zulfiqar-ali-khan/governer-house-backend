@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Messages to Governor</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item active">Messages to Governor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-condensed dt-responsive nowrap w-100 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Ref #</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>District</th>
                                    <th>Category</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    @php
                                        $imagesList = $message->images_list;
                                        $hasDoc = !empty($message->document);
                                        $hasImages = !empty($imagesList) && count($imagesList) > 0;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary font-size-11 font-monospace">
                                                {{ $message->reference_number ?? ('GOV-' . str_pad($message->id, 5, '0', STR_PAD_LEFT)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <strong>{{ $message->name }}</strong>
                                        </td>
                                        <td>
                                            <div>
                                                <div><i class="mdi mdi-email-outline text-muted me-1"></i><a href="mailto:{{ $message->email }}" class="text-body">{{ $message->email }}</a></div>
                                                @if($message->mobile_number)
                                                    <div><i class="mdi mdi-phone-outline text-muted me-1"></i><a href="tel:{{ $message->mobile_number }}" class="text-body">{{ $message->mobile_number }}</a></div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                           {{ $message->district ?? '—' }}
                                        </td>
                                        <td>
                                           {{ $message->category ?? '-' }}
                                        </td>
                                        <td>
                                            <span title="{{ $message->subject ?? '—' }}">
                                                {{ Str::limit($message->subject ?? '—', 28) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted font-size-12">{{ $message->created_at->format('d M, Y h:i A') }}</span>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View" data-bs-original-title="View">
                                                    <button type="button" class="btn btn-sm btn-soft-info"
                                                        data-bs-toggle="modal" data-bs-target="#viewMessageModal{{ $message->id }}"
                                                        title="View">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </button>
                                                </li>
                                                @can('talk-to-governor-delete')
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                                                    <form action="{{ route('talk-to-governors.destroy', $message->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-soft-danger delete-confirm" title="Delete">
                                                            <i class="mdi mdi-delete-outline"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                                @endcan
                                            </ul>
                                        </td>
                                    </tr>

                                    <!-- View Modal -->
                                    <div class="modal fade" id="viewMessageModal{{ $message->id }}" tabindex="-1"
                                        aria-labelledby="viewLabel{{ $message->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content tg-modal-content">
                                                <!-- Modal Header matching Image 1 -->
                                                <div class="modal-header tg-modal-header">
                                                    <div>
                                                        <h4 class="modal-title tg-modal-title" id="viewLabel{{ $message->id }}">
                                                            Submission Details
                                                        </h4>
                                                        <span class="tg-ref-pill">
                                                            Ref: {{ $message->reference_number ?? ('GOV-' . str_pad($message->id, 5, '0', STR_PAD_LEFT)) }}
                                                        </span>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body tg-modal-body">
                                                    <!-- 1. Citizen Information Card -->
                                                    <div class="card tg-detail-card">
                                                        <!-- Card Header -->
                                                        <div class="tg-card-header">
                                                            <span class="tg-card-header-icon">
                                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </span>
                                                            <h5 class="tg-card-header-title">Citizen Information</h5>
                                                        </div>

                                                        <!-- Card Body with 2 columns -->
                                                        <div class="card-body tg-card-body">
                                                            <div class="row g-0">
                                                                <!-- Left Column -->
                                                                <div class="col-md-6 pe-md-3 tg-vertical-divider">
                                                                    <!-- Full Name -->
                                                                    <div class="tg-field-item">
                                                                        <span class="tg-field-icon">
                                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                                <circle cx="12" cy="7" r="4"></circle>
                                                                            </svg>
                                                                        </span>
                                                                        <div>
                                                                            <div class="tg-field-label">Full Name</div>
                                                                            <div class="tg-field-value">{{ $message->name }}</div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="tg-field-divider">

                                                                    <!-- Mobile Number -->
                                                                    <div class="tg-field-item">
                                                                        <span class="tg-field-icon">
                                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                                            </svg>
                                                                        </span>
                                                                        <div>
                                                                            <div class="tg-field-label">Mobile Number</div>
                                                                            <div>
                                                                                @if($message->mobile_number)
                                                                                    <a href="tel:{{ $message->mobile_number }}" class="tg-field-link">{{ $message->mobile_number }}</a>
                                                                                @else
                                                                                    <span class="text-muted">—</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="tg-field-divider">

                                                                    <!-- District -->
                                                                    <div class="tg-field-item">
                                                                        <span class="tg-field-icon">
                                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                                                <circle cx="12" cy="10" r="3"></circle>
                                                                            </svg>
                                                                        </span>
                                                                        <div>
                                                                            <div class="tg-field-label">District</div>
                                                                            <div class="tg-field-value">{{ $message->district ?? '—' }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Right Column -->
                                                                <div class="col-md-6 ps-md-3">
                                                                    <!-- Email Address -->
                                                                    <div class="tg-field-item">
                                                                        <span class="tg-field-icon">
                                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                                                <polyline points="22,6 12,13 2,6"></polyline>
                                                                            </svg>
                                                                        </span>
                                                                        <div>
                                                                            <div class="tg-field-label">Email Address</div>
                                                                            <div>
                                                                                <a href="mailto:{{ $message->email }}" class="tg-field-link">{{ $message->email }}</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="tg-field-divider">

                                                                    <!-- CNIC -->
                                                                    <div class="tg-field-item">
                                                                        <span class="tg-field-icon">
                                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                                                <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                                                                <circle cx="8" cy="12" r="2"></circle>
                                                                                <line x1="13" y1="10" x2="18" y2="10"></line>
                                                                                <line x1="13" y1="14" x2="16" y2="14"></line>
                                                                            </svg>
                                                                        </span>
                                                                        <div>
                                                                            <div class="tg-field-label">CNIC</div>
                                                                            <div>
                                                                                @if($message->cnic)
                                                                                    <span class="tg-field-value">{{ $message->cnic }}</span>
                                                                                @else
                                                                                    <span class="tg-cnic-badge">Not provided</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="tg-field-divider">

                                                                    <!-- Category -->
                                                                    <div class="tg-field-item">
                                                                        <span class="tg-field-icon">
                                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                                                <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                                                                <polyline points="2 17 12 22 22 17"></polyline>
                                                                                <polyline points="2 12 12 17 22 12"></polyline>
                                                                            </svg>
                                                                        </span>
                                                                        <div>
                                                                            <div class="tg-field-label">Category</div>
                                                                            <div>
                                                                                <span class="tg-category-pill">
                                                                                  
                                                                                    {{ $message->category ?? 'General' }}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Bottom submission date bar -->
                                                            <div class="tg-submission-bar">
                                                                <span class="tg-submission-icon">
                                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                                                    </svg>
                                                                </span>
                                                                <span class="tg-submission-label">Submission Date & Time</span>
                                                                <span class="tg-submission-sep">|</span>
                                                                <strong class="tg-submission-val">{{ $message->created_at->format('l, d F Y – h:i A') }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 2. Message Card -->
                                                    <div class="card tg-detail-card">
                                                        <!-- Card Header -->
                                                        <div class="tg-card-header">
                                                            <span class="tg-card-header-icon">
                                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                                    <line x1="8" y1="9" x2="16" y2="9"></line>
                                                                    <line x1="8" y1="13" x2="14" y2="13"></line>
                                                                </svg>
                                                            </span>
                                                            <h5 class="tg-card-header-title">Message</h5>
                                                        </div>

                                                        <!-- Card Body -->
                                                        <div class="card-body tg-card-body">
                                                            <div class="mb-3">
                                                                <div class="tg-msg-subject-label">Subject</div>
                                                                <div class="tg-msg-subject-val">{{ $message->subject ?? 'No Subject' }}</div>
                                                            </div>
                                                            <div>
                                                                <div class="tg-msg-content-label">Message Content</div>
                                                                <div class="tg-msg-content-box">{{ $message->message }}</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 3. Attachments Card -->
                                                    <div class="card tg-detail-card mb-0">
                                                        <!-- Card Header -->
                                                        <div class="tg-card-header">
                                                            <span class="tg-card-header-icon">
                                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mdi-rotate-45">
                                                                    <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                                                                </svg>
                                                            </span>
                                                            <h5 class="tg-card-header-title">Attachments</h5>
                                                        </div>

                                                        <!-- Card Body -->
                                                        <div class="card-body tg-card-body">
                                                            <div class="row g-0">
                                                                <!-- Left: PDF Document -->
                                                                <div class="col-md-6 pe-md-3 tg-vertical-divider pb-3 pb-md-0">
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <!-- Red PDF icon matching Image 1 -->
                                                                        <span class="tg-pdf-icon">
                                                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="#ef4444" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                                                                <polyline points="14 2 14 8 20 8" stroke="#ef4444" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                                                                <text x="6" y="16.5" fill="#ef4444" font-size="6.5" font-weight="bold" font-family="Arial, sans-serif">PDF</text>
                                                                            </svg>
                                                                        </span>
                                                                        <strong class="tg-attach-label">Attached Document (PDF)</strong>
                                                                    </div>
                                                                    @if($hasDoc)
                                                                        <a href="{{ asset($message->document) }}" target="_blank" class="tg-pdf-btn">
                                                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                                                <polyline points="7 10 12 15 17 10"></polyline>
                                                                                <line x1="12" y1="15" x2="12" y2="3"></line>
                                                                            </svg>
                                                                            Download / View Attached PDF
                                                                        </a>
                                                                    @else
                                                                        <div class="tg-empty-attach">No PDF document attached</div>
                                                                    @endif
                                                                </div>

                                                                <!-- Right: Images -->
                                                                <div class="col-md-6 ps-md-3">
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <span class="tg-img-icon">
                                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                                                <polyline points="21 15 16 10 5 21"></polyline>
                                                                            </svg>
                                                                        </span>
                                                                        <strong class="tg-attach-label">Attached Images ({{ count($imagesList) }})</strong>
                                                                    </div>
                                                                    @if($hasImages)
                                                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                                                            @foreach($imagesList as $imagePath)
                                                                                <a href="{{ asset($imagePath) }}" target="_blank" class="tg-thumb-card" title="Click to view full image">
                                                                                    <img src="{{ asset($imagePath) }}" alt="Attached photo" class="tg-thumb-img">
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <div class="tg-empty-attach">No images attached</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
