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

</html>