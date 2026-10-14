<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | GOVERNOR HOUSE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Dashboard | GOVERNOR HOUSE" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="{{ asset('assets/js/plugin.js') }}"></script>

    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}">
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')

    <style>
        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            filter: brightness(0) invert(1);
        }

        .site-title {
            display: flex;
            flex-direction: column;
            margin-left: 10px;
            color: #ffffff;
        }

        .site-title span:first-child {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            color: var(--yellow);
            letter-spacing: 1.5px;
        }

        .site-title span:last-child {
            font-size: 10px;
            letter-spacing: 1.5px;
            font-weight: 600;
            text-transform: uppercase;

        }
    </style>

</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a class="navbar-brand" href="/">
                            <div class="logo-sm">
                                  <img src="{{ asset('front_assets/imgs/logo.png') }}" width="50" alt="">
                            </div>
                            <div class="logo-lg">
                                <img src="{{ asset('front_assets/imgs/logo.png') }}" width="50" alt="">
                                <div class="site-title">
                                    <span>Governor House</span>
                                    <span>Khyber Pakhtunkhwa</span>
                                </div>
                            </div>

                        </a>

                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- App Search-->



                </div>

                <div class="d-flex">




                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-customize"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <div class="px-lg-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/github.png') }}" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/bitbucket.png') }}"
                                                alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/dribbble.png') }}" alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/dropbox.png') }}" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/mail_chimp.png') }}"
                                                alt="mail_chimp">
                                            <span>Mail Chimp</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/slack.png') }}" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-bell bx-tada"></i>
                            <span class="badge bg-danger rounded-pill">3</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small" key="t-view-all"> View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <a href="javascript: void(0);" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="bx bx-cart"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1" key="t-your-order">Your order is placed</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" key="t-grammer">If several languages coalesce the
                                                    grammar</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                        key="t-min-ago">3 min ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript: void(0);" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">James Lemire</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" key="t-simplified">It will seem like simplified
                                                    English.
                                                </p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                        key="t-hours-ago">1 hours ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript: void(0);" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-success rounded-circle font-size-16">
                                                <i class="bx bx-badge-check"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1" key="t-shipped">Your item is shipped</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" key="t-grammer">If several languages coalesce the
                                                    grammar</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                        key="t-min-ago">3 min ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="javascript: void(0);" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/images/users/avatar-4.jpg') }}"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Salena Layfield</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" key="t-occidental">As a skeptical Cambridge friend
                                                    of
                                                    mine occidental.</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                        key="t-hours-ago">1 hours ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View
                                        More..</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ Auth::user()->image ? asset('images/profile/' . Auth::user()->image) : asset('avatar.png') }}"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1"
                                key="t-henry">{{ Auth::user()->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                    class="bx bx-user font-size-16 align-middle me-1"></i>
                                <span key="t-profile">Profile</span></a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item text-danger" h href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i
                                    class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                    key="t-logout">Logout</span></a>
                        </div>
                    </div>



                </div>
            </div>
        </header>

        @include('layouts.sidebar')



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->



            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © GOVERNOR HOUSE.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by KPITB
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <!-- toastr plugin -->
    <script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>

    <!-- toastr init -->
    <script src="{{ asset('assets/js/pages/toastr.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif

            @if (session('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif

            @if (session('info'))
                toastr.info("{{ session('info') }}");
            @endif

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Generic Delete Confirmation using SweetAlert2
            $(document).on('click', '.delete-confirm', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @yield('script')
</body>

</html>
