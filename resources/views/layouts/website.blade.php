<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy"
        content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; connect-src 'self' http://roadmap-aichatbot.kpitb.online https://roadmap-aichatbot.kpitb.online; img-src 'self' data:;">
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
                <!-- Column 1: Header -->
                <div class="col-lg-3 col-md-12">
                    <h3 class="footer-title">QUICK LINKS</h3>
                </div>

                <!-- Column 2: Links List 1 -->
                <div class="col-lg-3 col-md-4">
                    <ul class="footer-links">
                        <li><a href="#">University Of Engineering & Technology</a></li>
                        <li><a href="#">The University of Agriculture, Peshawar</a></li>
                        <li><a href="#">Bacha Khan University</a></li>
                        <li><a href="#">University Of Malakand</a></li>
                    </ul>
                </div>

                <!-- Column 3: Links List 2 -->
                <div class="col-lg-3 col-md-4">
                    <ul class="footer-links">
                        <li><a href="#">Shaheed Benazir Bhutto University</a></li>
                        <li><a href="#">University Of Swabi</a></li>
                        <li><a href="#">Hazara University</a></li>
                        <li><a href="#">University Of Fata</a></li>
                    </ul>
                </div>

                <!-- Column 4: Links List 3 -->
                <div class="col-lg-3 col-md-4">
                    <ul class="footer-links">
                        <li><a href="#">President's Office</a></li>
                        <li><a href="#">Prime Minister's Office</a></li>
                        <li><a href="#">Khyber Pakhtunkhwa Assembly</a></li>
                        <li><a href="#">Khyber Pakhtunkhwa Government</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="mb-0">© Governor KP 2023 & 2024, Developed By - <span class="highlight">KPITB</span></p>
            </div>
        </div>
    </footer>

    </div>
</body>

<script src="{{ asset('front_assets/js/jquery.js') }}"></script>
<script src="{{ asset('front_assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front_assets/slick-1.8.1/slick/slick.min.js') }}"></script>
<script src="{{ asset('front_assets/js/slider.js') }}"></script>

</html>