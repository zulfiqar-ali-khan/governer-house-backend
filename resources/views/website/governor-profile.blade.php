@extends('layouts.website')

@section('content')
    <!-- Hero Profile Section -->
    <section class="gov-profile-hero">

        <div class="container position-relative">
            <!-- Breadcrumb -->
            <div class="gov-profile-breadcrumb">
                <a href="{{ route('index') }}" class="gov-breadcrumb-link">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="gov-breadcrumb-icon">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Home
                </a>
                <span class="gov-breadcrumb-sep">/</span>
                <span class="gov-breadcrumb-current">Governor's Profile</span>
            </div>

            <!-- Hero Main Row -->
            <div class="row align-items-center gov-hero-main-row">
                <!-- Left: Portrait Frame -->
                <div class="col-lg-auto col-md-4 text-center text-md-start mb-4 mb-md-0">
                    <div class="gov-hero-portrait-frame">
                        <img src="{{ asset($governorMessage->image ?? 'front_assets/imgs/governor.jpeg') }}" alt="{{ $governorMessage->name ?? 'Faisal Karim Kundi' }}" class="gov-hero-portrait-img">
                    </div>
                </div>

                <!-- Right: Bio Intro -->
                <div class="col-lg col-md-8 ps-md-4">
                    <div class="gov-hero-content">
                        <div class="gov-hero-eyebrow">— BIOGRAPHICAL NOTE</div>
                        <h1 class="gov-hero-name">{{ $governorMessage->name ?? 'Faisal Karim Kundi' }}</h1>
                        <div class="gov-hero-role-primary">{{ $governorMessage->title ?? '34th Governor of Khyber Pakhtunkhwa' }}</div>
                        <div class="gov-hero-role-secondary">{{ $governorMessage->also_serves_as ?? 'President, Pakistan Red Crescent Society, KP Chapter' }}</div>
                        <p class="gov-hero-bio">
                            {{ $governorMessage->short_description ?? "A senior Pakistani statesman serving as the 34th Governor of Khyber Pakhtunkhwa since 4 May 2024, and President of the Pakistan Red Crescent Society, Khyber Pakhtunkhwa Chapter, the province's principal humanitarian and disaster response institution." }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Profile Content Section -->
    <section class="gov-profile-body-section">
        <div class="container py-lg-4">
            <div class="row g-4 g-xl-5">
                <!-- Left Column: Biography Sections -->
                <div class="col-lg-8">
                    <!-- 1. Parliamentary and Political Career -->
                    <div class="gov-profile-block">
                        <div class="gov-ribbon-heading">
                            <span class="gov-ribbon-accent"></span>
                            <h3 class="gov-ribbon-title"><span>PARLIAMENTARY AND POLITICAL CAREER</span></h3>
                        </div>
                        <div class="gov-block-content">
                            @if(!empty($governorMessage?->political_career))
                                {!! $governorMessage->political_career !!}
                            @else
                                <p>
                                    Mr. Kundi was elected to the 13th National Assembly of Pakistan in the general elections of February 2008. On 19 March 2008 he was elected the 17th Deputy Speaker of the National Assembly, becoming at the time the youngest Deputy Speaker in the Assembly's history.
                                </p>
                                <p>
                                    He represented Pakistan at international forums, diplomatic engagements and policy dialogues, and worked on infrastructure development, educational reform and philanthropic initiatives in his constituency. He later served as Special Assistant to the Prime Minister on Poverty Alleviation and Social Safety.
                                </p>
                                <p>
                                    Within the Pakistan Peoples Party, he has served as Central Secretary Information and continues as a member of the Central Executive Committee and the Foreign Liaison Committee. He has championed organisational and grassroots reforms for a more people centred political culture.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- 2. Humanitarian and Public Leadership -->
                    <div class="gov-profile-block">
                        <div class="gov-ribbon-heading">
                            <span class="gov-ribbon-accent"></span>
                            <h3 class="gov-ribbon-title"><span>HUMANITARIAN AND PUBLIC LEADERSHIP</span></h3>
                        </div>
                        <div class="gov-block-content">
                            @if(!empty($governorMessage?->public_leadership))
                                {!! $governorMessage->public_leadership !!}
                            @else
                                <p>
                                    As President of the Pakistan Red Crescent Society, Khyber Pakhtunkhwa, Mr. Kundi guides the province's leading humanitarian organisation in disaster preparedness, relief and community resilience, working closely with national and international partners including the International Federation of Red Cross and Red Crescent Societies (IFRC).
                                </p>
                                <p>
                                    As Patron of the Young Parliamentarians Forum (2008 to 2013) and the Youth Parliament, and as a member of the Executive Committee of the Inter-Parliamentary Union (IPU), he was an early advocate for youth political engagement. As Chairman of the FATA Caucus, a grouping of MNAs and Senators from the erstwhile Federally Administered Tribal Areas and adjoining districts, he promoted democratic dialogue and reforms affecting the region.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- 3. Education -->
                    <div class="gov-profile-block">
                        <div class="gov-ribbon-heading">
                            <span class="gov-ribbon-accent"></span>
                            <h3 class="gov-ribbon-title"><span>EDUCATION</span></h3>
                        </div>
                        <div class="gov-block-content">
                            @if(!empty($governorMessage?->education_description))
                                <p>{{ $governorMessage->education_description }}</p>
                            @else
                                <p>
                                    Mr. Kundi studied law at Thames Valley College, London, United Kingdom, graduating in 2002, before returning to Pakistan to pursue a career in public service.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- 4. Family and Background -->
                    <div class="gov-profile-block">
                        <div class="gov-ribbon-heading">
                            <span class="gov-ribbon-accent"></span>
                            <h3 class="gov-ribbon-title"><span>FAMILY AND BACKGROUND</span></h3>
                        </div>
                        <div class="gov-block-content">
                            <p class="gov-block-lead">
                                {{ $governorMessage->family_background ?? 'Born in Dera Ismail Khan, a historic city of Khyber Pakhtunkhwa, Mr. Kundi belongs to a political family with a multi generational record of public service.' }}
                            </p>

                            <!-- Ancestry Timeline Tree -->
                            <div class="gov-ancestry-tree">
                                @php
                                    $ancestryItems = $governorMessage?->ancestry_list;
                                    if (empty($ancestryItems)) {
                                        $ancestryItems = [
                                            [ 'relation' => 'GREAT GRANDFATHER', 'name' => 'Barrister Abdul Rahim Kundi', 'description' => 'First Deputy Speaker of the Legislative Assembly, 1932 to 1937' ],
                                            [ 'relation' => 'GRANDFATHER', 'name' => 'Fazal Qadeem Kundi', 'description' => 'Member, West Pakistan Assembly, 1960s' ],
                                            [ 'relation' => 'MATERNAL GRANDFATHER', 'name' => 'Justice (Retd.) Faizullah Khan Kundi', 'description' => "Federal Minister for Establishment in Prime Minister Zulfiqar Ali Bhutto's first cabinet; Chairman, Federal Public Service Commission, 1972 to 1979" ],
                                            [ 'relation' => 'FATHER', 'name' => 'Fazal Karim Kundi', 'description' => 'Chairman, District Council D.I. Khan, 1983 to 1991; elected Member of the National Assembly in 1990' ],
                                        ];
                                    }
                                @endphp

                                @foreach($ancestryItems as $ancestor)
                                    <div class="gov-tree-node">
                                        <div class="gov-tree-bullet"></div>
                                        <div class="gov-tree-info">
                                            <span class="gov-tree-generation">{{ $ancestor['relation'] ?? 'FAMILY MEMBER' }}</span>
                                            <h5 class="gov-tree-name">{{ $ancestor['name'] ?? '' }}</h5>
                                            <p class="gov-tree-desc">{{ $ancestor['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- 5. Role of the Governor -->
                    <div class="gov-profile-block mb-0">
                        <div class="gov-ribbon-heading">
                            <span class="gov-ribbon-accent"></span>
                            <h3 class="gov-ribbon-title"><span>ROLE OF THE GOVERNOR</span></h3>
                        </div>
                        <div class="gov-block-content">
                            <p class="gov-block-lead">
                                Under the Constitution of Pakistan, the Governor is appointed by the President and represents the Federation in the province.
                            </p>

                           

                            <div class="row g-3 gov-role-grid">
                                @foreach($governorMessage?->roles_list as $idx => $roleText)
                                    <div class="col-sm-6">
                                        <div class="gov-role-card">
                                            <div class="gov-role-text">
                                                {{ $roleText }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: At a Glance Card -->
                <div class="col-lg-4">
                    <div class="gov-glance-card">
                        <h4 class="gov-glance-title">At a Glance</h4>
                        <div class="gov-glance-accent"></div>

                        <div class="gov-glance-list">
                            <!-- Item 1: Office -->
                            <div class="gov-glance-item">
                                <div class="gov-glance-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="3" y1="21" x2="21" y2="21"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                        <polyline points="5 6 12 3 19 6"></polyline>
                                        <line x1="4" y1="10" x2="4" y2="21"></line>
                                        <line x1="20" y1="10" x2="20" y2="21"></line>
                                        <line x1="8" y1="14" x2="8" y2="17"></line>
                                        <line x1="12" y1="14" x2="12" y2="17"></line>
                                        <line x1="16" y1="14" x2="16" y2="17"></line>
                                    </svg>
                                </div>
                                <div class="gov-glance-info">
                                    <span class="gov-glance-label">OFFICE</span>
                                    <strong class="gov-glance-val">{{ $governorMessage->designation ?? '34th Governor of Khyber Pakhtunkhwa' }}</strong>
                                </div>
                            </div>

                            <!-- Item 2: Assumed Office -->
                            <div class="gov-glance-item">
                                <div class="gov-glance-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="gov-glance-info">
                                    <span class="gov-glance-label">ASSUMED OFFICE</span>
                                    <strong class="gov-glance-val">{{ $governorMessage?->from ? \Carbon\Carbon::parse($governorMessage->from)->format('d F Y') : '4 May 2024' }}</strong>
                                </div>
                            </div>

                            <!-- Item 3: Also Serves As -->
                            <div class="gov-glance-item">
                                <div class="gov-glance-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                    </svg>
                                </div>
                                <div class="gov-glance-info">
                                    <span class="gov-glance-label">ALSO SERVES AS</span>
                                    <strong class="gov-glance-val">{{ $governorMessage->also_serves_as ?? 'President, PRCS Khyber Pakhtunkhwa' }}</strong>
                                </div>
                            </div>

                            <!-- Item 4: Born -->
                            <div class="gov-glance-item">
                                <div class="gov-glance-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="gov-glance-info">
                                    <span class="gov-glance-label">BORN</span>
                                    <strong class="gov-glance-val">{{ $governorMessage->born ?? 'Dera Ismail Khan' }}</strong>
                                </div>
                            </div>

                            <!-- Item 5: Education -->
                            <div class="gov-glance-item">
                                <div class="gov-glance-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                                    </svg>
                                </div>
                                <div class="gov-glance-info">
                                    <span class="gov-glance-label">EDUCATION</span>
                                    <strong class="gov-glance-val">{{ $governorMessage->education ?? ($governorMessage->education_degree ?? 'Law, Thames Valley College, London (2002)') }}</strong>
                                </div>
                            </div>

                            <!-- Item 6: Previous Office -->
                            <div class="gov-glance-item">
                                <div class="gov-glance-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </div>
                                <div class="gov-glance-info">
                                    <span class="gov-glance-label">PREVIOUS OFFICE</span>
                                    <strong class="gov-glance-val">{{ $governorMessage->previous_office ?? '17th Deputy Speaker, National Assembly (2008 to 2013)' }}</strong>
                                </div>
                            </div>
                        </div>

                        <hr class="gov-glance-divider">

                        <!-- Scan To Connect Box -->
                        <div class="gov-scan-connect-box">
                            <div class="gov-qr-code-wrapper">
                                <svg width="58" height="58" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg" class="gov-qr-svg">
                                    <rect width="29" height="29" fill="#ffffff"/>
                                    <rect x="2" y="2" width="7" height="7" fill="#000000"/>
                                    <rect x="3" y="3" width="5" height="5" fill="#ffffff"/>
                                    <rect x="4" y="4" width="3" height="3" fill="#000000"/>
                                    <rect x="20" y="2" width="7" height="7" fill="#000000"/>
                                    <rect x="21" y="3" width="5" height="5" fill="#ffffff"/>
                                    <rect x="22" y="4" width="3" height="3" fill="#000000"/>
                                    <rect x="2" y="20" width="7" height="7" fill="#000000"/>
                                    <rect x="3" y="21" width="5" height="5" fill="#ffffff"/>
                                    <rect x="4" y="22" width="3" height="3" fill="#000000"/>
                                    <rect x="11" y="2" width="2" height="2" fill="#000000"/>
                                    <rect x="15" y="2" width="2" height="2" fill="#000000"/>
                                    <rect x="11" y="6" width="3" height="2" fill="#000000"/>
                                    <rect x="16" y="5" width="2" height="3" fill="#000000"/>
                                    <rect x="2" y="11" width="3" height="2" fill="#000000"/>
                                    <rect x="6" y="11" width="2" height="3" fill="#000000"/>
                                    <rect x="11" y="11" width="3" height="3" fill="#000000"/>
                                    <rect x="16" y="11" width="2" height="2" fill="#000000"/>
                                    <rect x="20" y="11" width="3" height="2" fill="#000000"/>
                                    <rect x="25" y="11" width="2" height="3" fill="#000000"/>
                                    <rect x="11" y="16" width="2" height="3" fill="#000000"/>
                                    <rect x="15" y="15" width="3" height="2" fill="#000000"/>
                                    <rect x="2" y="16" width="2" height="2" fill="#000000"/>
                                    <rect x="6" y="16" width="3" height="2" fill="#000000"/>
                                    <rect x="11" y="21" width="2" height="2" fill="#000000"/>
                                    <rect x="15" y="20" width="2" height="3" fill="#000000"/>
                                    <rect x="19" y="21" width="3" height="2" fill="#000000"/>
                                    <rect x="24" y="20" width="3" height="3" fill="#000000"/>
                                    <rect x="11" y="25" width="3" height="2" fill="#000000"/>
                                    <rect x="16" y="25" width="2" height="2" fill="#000000"/>
                                    <rect x="20" y="25" width="2" height="2" fill="#000000"/>
                                    <rect x="24" y="25" width="3" height="2" fill="#000000"/>
                                </svg>
                            </div>
                            <div class="gov-scan-info">
                                <h6 class="gov-scan-title">Scan to connect</h6>
                                <p class="gov-scan-sub">QR links to the Governor's official channels.</p>
                                <div class="gov-social-pill-group">
                                    <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="gov-social-pill-btn" aria-label="X Profile">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                    </a>
                                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="gov-social-pill-btn" aria-label="Facebook Profile">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
