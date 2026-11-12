<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy"
        content="@if(!app()->isLocal()) upgrade-insecure-requests; @endif default-src 'self'; script-src 'self' https://www.google.com/recaptcha/ https://www.gstatic.com/recaptcha/; frame-src 'self' https://www.google.com/recaptcha/ https://recaptcha.google.com/; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://www.gstatic.com; font-src 'self' https://fonts.gstatic.com; connect-src 'self' http://roadmap-aichatbot.kpitb.online https://roadmap-aichatbot.kpitb.online https://www.google.com/recaptcha/; img-src 'self' data: https://www.google.com/recaptcha/ https://www.gstatic.com/recaptcha/;">
    <title> GOVERNER HOUSE | HOME </title>
    <link rel="stylesheet" href="{{ asset('front_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/slick-1.8.1/slick/slick.css') }}" />
</head>

<body>
    <div class="wrap">

        @include('layouts.manu')

        @yield('content')

    </div>
    <footer>
        <div class="container">
            <div class="row g-4 footer-top">
                <!-- Column 1: Header & Social Links -->
                <div class="col-lg-3 col-md-12">
                    <h3 class="footer-title">QUICK LINKS</h3>
                    <div class="footer-social-wrapper">
                        <div class="footer-social-links">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/GovernorKhyberPakhtunkhwa/about/" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Facebook" title="Facebook">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <!-- Twitter / X -->
                            <a href="https://x.com/fkkundi" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Twitter / X" title="Twitter / X">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </a>
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/governorkhyberpakhtunkhwa/?hl=en" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Instagram" title="Instagram">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            {{-- <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="LinkedIn" title="LinkedIn">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a> --}}
                        </div>
                    </div>
                </div>

                <!-- Column 2: Links List 1 -->
                <div class="col-lg-3 col-md-4">
                    <ul class="footer-links">
                        <li><a href="http://www.uetpeshawar.edu.pk" target="_blank" rel="noopener noreferrer">University Of Engineering & Technology</a></li>
                        <li><a href="http://www.aup.edu.pk/" target="_blank" rel="noopener noreferrer">The University of Agriculture, Peshawar</a></li>
                        <li><a href="http://www.bkuc.edu.pk/" target="_blank" rel="noopener noreferrer">Bacha Khan University</a></li>
                        <li><a href="http://www.uom.edu.pk" target="_blank" rel="noopener noreferrer">University Of Malakand</a></li>
                    </ul>
                </div>

                <!-- Column 3: Links List 2 -->
                <div class="col-lg-3 col-md-4">
                    <ul class="footer-links">
                        <li><a href="https://sbbu.edu.pk/" target="_blank" rel="noopener noreferrer">Shaheed Benazir Bhutto University</a></li>
                        <li><a href="http://www.uoswabi.edu.pk" target="_blank" rel="noopener noreferrer">University Of Swabi</a></li>
                        <li><a href="http://www.hu.edu.pk" target="_blank" rel="noopener noreferrer">Hazara University</a></li>
                        <li><a href="http://www.fu.edu.pk/" target="_blank" rel="noopener noreferrer">University Of Fata</a></li>
                    </ul>
                </div>

                <!-- Column 4: Links List 3 -->
                <div class="col-lg-3 col-md-4">
                    <ul class="footer-links">
                        <li><a href="http://president.gov.pk/" target="_blank" rel="noopener noreferrer">President's Office</a></li>
                        <li><a href="http://pmo.gov.pk/" target="_blank" rel="noopener noreferrer">Prime Minister's Office</a></li>
                        <li><a href="https://www.pakp.gov.pk/" target="_blank" rel="noopener noreferrer">Khyber Pakhtunkhwa Assembly</a></li>
                        <li><a href="https://kp.gov.pk/" target="_blank" rel="noopener noreferrer">Khyber Pakhtunkhwa Government</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="mb-0">© Governor KP {{ date('Y') }}, Developed By 
                     <a href="http://www.kpitb.gov.pk" target="_blank" rel="noopener noreferrer" class="highlight text-decoration-none">KPITB</a></p>
            </div>
        </div>
    </footer>
</body>

<script src="{{ asset('front_assets/js/jquery.js') }}"></script>
<script src="{{ asset('front_assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front_assets/slick-1.8.1/slick/slick.min.js') }}"></script>
<script src="{{ asset('front_assets/js/slider.js') }}"></script>
<script src="{{ asset('front_assets/js/talk-to-governor.js') }}"></script>
@yield('scripts')

</html>