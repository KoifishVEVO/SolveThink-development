<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title> <!-- Dynamic Title -->

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* --- Existing Base Styles (Keep As Is) --- */
        .sidebar.toggled .nav-item .nav-link span {
            display: none;
        }

        .sidebar.toggled .sidebar-heading span {
            display: none;
        }

        .sidebar-color {
            background-color: #272780;
        }

        .sidebar-item-color {
            color: #A9B5DF;
        }

        .sidebar.toggled .welcome-text {
            display: none;
        }

        /* Icon display logic is refined below */
        .sidebar.toggled .sidebar-heading-icon {
            display: block;
            text-align: center;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .sidebar .sidebar-heading-icon {
            display: none;
        }

        .sidebar-item-color:hover {
            background-color: #A9B5DF;
            color: #FFFFFF;
        }

        .bg-footer {
            background-color: white;
            color: #272780;
            font-weight: 500;
        }

        .scroll-to-top {
            position: fixed;
            right: 1rem;
            bottom: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            background-color: #272780 !important;
            border-radius: 50%;
            z-index: 1030;
            /* Lower than topbar/sidebar overlay */
            opacity: 0.7;
            transition: opacity 0.3s;
            text-decoration: none;
        }

        .scroll-to-top i {
            color: white;
            font-size: 1rem;
        }

        .scroll-to-top:hover {
            opacity: 1;
        }


        /* --- Layout Adjustments --- */

        /* Define Topbar Height Variable (adjust if your topbar height differs) */
        :root {
            --topbar-height: 68px;
            /* Default SB Admin 2 topbar height */
        }

        /* 1. Content Padding for Fixed Topbar */
        #content {
            padding-top: var(--topbar-height);
        }

        /* 2. Sticky Topbar z-index */
        .navbar.fixed-top {
            z-index: 1035;
            /* Ensure topbar is above most content but potentially below modals/mobile sidebar overlay initially */
        }

        /* Ensure mobile toggle button is high enough */
        #sidebarToggleTop {
            z-index: 1036;
            /* Slightly higher than topbar itself */
            position: relative;
            /* Needed for z-index to work reliably on buttons */
        }

        /* 3. Sticky Sidebar (Desktop) */
        @media (min-width: 768px) {
            #accordionSidebar {
                position: sticky;
                top: 0;


                height: calc(100vh - var(--topbar-height));
                /* Full height minus topbar */
                z-index: 1045;
                /* Below topbar */
                overflow-y: auto;
                /* Allow internal scrolling */
                overflow-x: hidden;
                /* Prevent horizontal scroll */
            }

            /* Desktop Toggled Icon */
            .sidebar.toggled .welcome-icon {
                display: block;
                max-width: 40px;
                margin: 0 auto;
            }

            .sidebar:not(.toggled) .welcome-icon {
                /* Hide icon explicitly when not toggled */
                display: none;
            }
        }

        /* 4. Sticky Footer Flexbox */
        #content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #content {
            flex-grow: 1;
        }


        /* 5. Mobile Sidebar Adjustments */
        @media (max-width: 767.98px) {
            #accordionSidebar {
                /* !FIX Fixed position, off-screen initially */
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: var(--sidebar-width);
                /* !FIX z-index below mobile toggle button but above content */
                z-index: 1040;
                /* !FIX Hide off-screen using transform */
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                /* Animate the slide */
                overflow-y: auto;
                overflow-x: hidden;
            }

            body.sidebar-toggled #accordionSidebar {
                transform: translateX(0);
                /* Slide in */
            }

            /* When mobile sidebar is shown (usually adds .show class via Bootstrap JS) */
            #accordionSidebar.show {
                z-index: 1040;
                /* Make sure sidebar overlay is above content, slightly above topbar */
                /* SB Admin 2 default CSS handles the slide-in */
            }

            /* Mobile - Show small icon, hide text when sidebar is active/shown */
            #accordionSidebar.show .sidebar-brand-icon .welcome-icon {
                display: block;
                /* Show the small icon */
                max-width: 40px;
                margin: 0 auto 0.5rem auto;
                /* Add some bottom margin */
            }

            #accordionSidebar.show .sidebar-brand-text {
                display: none;
                /* Hide the full logo text */
            }

            /* Mobile - Hide small icon when sidebar is hidden */
            #accordionSidebar:not(.show) .welcome-icon {
                display: none;
            }

            /* Mobile - Ensure full logo text shows when hidden */
            #accordionSidebar:not(.show) .sidebar-brand-text {
                display: block;
                /* Or inline, depending on original style */
            }
        }

        /* Default state for welcome icon (hidden) */
        .welcome-icon {
            display: none;
        }
    </style>


    @yield('styles')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar-color sidebar sidebar-dark accordion" id="accordionSidebar">
            <div class="sidebar-brand d-flex flex-column align-items-center justify-content-center">
                <!-- Logo Icon -->
                <div class = "sidebar-brand-icon">
                    <a href="{{ url('/') }}" class="mb-2 text-gray-400">
                        <img src="{{ asset('assets/images/welcome_icon.png') }}" alt="SolveThink" class="welcome-icon">
                    </a>
                </div>

                <!-- Logo Text -->
                <div class="sidebar-brand-text ">
                    <a href="{{ url('/') }}" class=" text-center sidebar-brand-text ">
                        <img src="{{ asset('assets/images/solvethink.png') }}" alt="SolveThink Logo"
                            class="img-fluid rounded" style="max-width: 100%;">
                    </a>
                </div>
            </div>




            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                <i class="fas fa-th-large sidebar-heading-icon"></i>
                <span>Pengelolaan Barang</span>
            </div>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link " href="{{ '/dashboard' }}">
                    <i class="fas fa-list text-gray-400"></i>
                    <span>Rincian Nama Barang</span>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBaru') }}">
                    <i class="fas fa-file-alt text-gray-400"></i>
                    <span>Asset Barang Baru</span>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBekas') }}">
                    <i class="fas fa-sync-alt text-gray-400"></i>
                    <span>Asset Barang Bekas</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                <i class="fas fa-chart-line sidebar-heading-icon"></i>
                <span>Pengelolaan Keuangan</span>
            </div>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/periode') }}">
                    <i class="fa fa-calendar text-gray-400"></i>
                    <span>Periode</span>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBaru') }}">
                    <!-- temporary small, use span later when icon exist -->
                    <small>Rincian Belanja</small>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBekas') }}">
                    <small>Penjualan Barang</small>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBekas') }}">
                    <small>Penyewaan Barang</small>
                </a>
            </li>

            <!-- divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- sidebar toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed-top">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Notification Icon -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button">
                                <i class="fas fa-bell text-dark fa-lg"></i>
                            </a>
                        </li>

                        <!-- Message Icon -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button">
                                <i class="fas fa-envelope text-dark fa-lg"></i>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - Urse Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3 d-none d-lg-inline text-dark small">Lorem Ipsum</span>
                                <i class="fas fa-user text-dark fa-lg"></i>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="px-3 py-2 d-lg-none fs-5">
                                    <span class="text-dark text-center ml-2 fs-5">Lorem Ipsum</span>
                                    <hr class="my-1">
                                </div>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-dark"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-dark"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ '/login' }}" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-dark"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Main Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span class="font-weight-bold text-medium fs-5">Copyright &copy; 2025 SolveThink. All
                                rights reserved.</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded-circle" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{ '/login' }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @yield('scripts')

</body>

</html>
