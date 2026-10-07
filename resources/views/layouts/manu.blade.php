<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="{{ asset('front_assets/imgs/logo.png') }}" width="50"
                    alt="">
                <div class="site-title">
                    <span>Governor House</span>
                    <span>Khyber Pakhtunkhwa</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">HOME</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('former-governor') }}">Governors</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('former-secretory') }}">Secretaries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT US</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news') }}">NEWS & EVENTS</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDownloads" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            DOWNLOADS
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownDownloads">
                            <li><a class="dropdown-item" href="#">Acts & Rules</a></li>
                            <li><a class="dropdown-item" href="#">Notifications</a></li>
                        </ul>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">CONTACT US</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
