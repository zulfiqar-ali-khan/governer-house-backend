<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Governor House Khyber Pakhtunkhwa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Governor House Khyber Pakhtunkhwa Official Administrative Portal" name="description" />
    <meta content="Governor House KP" name="author" />
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('front_assets/imgs/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/login.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="{{ asset('assets/js/plugin.js') }}"></script>

    
</head>

<body>
    <!-- Ambient Background Glows -->
    <div class="ambient-orb orb-1"></div>
    <div class="ambient-orb orb-2"></div>

    <div class="login-wrapper">
        

        <!-- Login Card -->
        <div class="login-card">
            <!-- Header & Logo -->
            <div class="card-header-area">
                <div class="logo-wrapper">
                    <a href="{{ route('index') }}" class="logo-badge" title="Governor House KP">
                        <img src="{{ asset('front_assets/imgs/logo.png') }}" alt="Governor House Logo">
                    </a>
                </div>
                <div>
                    <div class="govt-tag">
                        <i class="mdi mdi-shield-check"></i>
                        <span>Government of KP</span>
                    </div>
                    <h1 class="portal-title">Administrative Portal</h1>
                    <p class="portal-subtitle">Governor House Khyber Pakhtunkhwa</p>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="form-group-custom">
                    <label for="email" class="form-label-custom">
                        <span>Email Address</span>
                    </label>
                    <div class="input-box-wrapper">
                        <i class="mdi mdi-email-outline input-icon-prefix"></i>
                        <input type="email" 
                               id="email" 
                               class="form-control-custom" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="admin@governorhouse.gov.pk" 
                               required 
                               autofocus 
                               autocomplete="username">
                    </div>
                    @if ($errors->has('email'))
                        <div class="error-message">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <span>{{ $errors->first('email') }}</span>
                        </div>
                    @endif
                </div>

                <!-- Password Input -->
                <div class="form-group-custom">
                    <label for="password" class="form-label-custom">
                        <span>Password</span>
                    </label>
                    <div class="input-box-wrapper">
                        <i class="mdi mdi-lock-outline input-icon-prefix"></i>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-control-custom" 
                               placeholder="••••••••••••"
                               style="padding-right: 48px;" 
                               required 
                               autocomplete="current-password">
                        <button class="password-toggle-btn" type="button" id="password-addon" aria-label="Toggle password visibility">
                            <i class="mdi mdi-eye-outline" id="toggle-password-icon"></i>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <div class="error-message">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <span>{{ $errors->first('password') }}</span>
                        </div>
                    @endif
                </div>

                <!-- Options Row (Remember Me) -->
                <div class="form-options-row">
                    <label class="custom-checkbox-label" for="remember">
                        <input type="checkbox" id="remember" name="remember">
                        <span>Remember credentials</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button class="btn-submit-custom waves-effect waves-light" type="submit">
                    <span>Sign In to Portal</span>
                    <i class="mdi mdi-arrow-right"></i>
                </button>
            </form>

           
        </div>

        <!-- Portal Copyright -->
        <div class="portal-copyright">
            &copy; {{ date('Y') }} <a href="{{ route('index') }}">Governor House KP</a>. All rights reserved.
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        // Password visibility toggle icon enhancement
        $(document).ready(function() {
            $('#password-addon').on('click', function() {
                var $icon = $(this).find('i');
                var $input = $(this).siblings('input');
                if ($input.attr('type') === 'text' || $input.attr('type') === 'input') {
                    $icon.removeClass('mdi-eye-outline').addClass('mdi-eye-off-outline');
                } else {
                    $icon.removeClass('mdi-eye-off-outline').addClass('mdi-eye-outline');
                }
            });
        });
    </script>
</body>

</html>