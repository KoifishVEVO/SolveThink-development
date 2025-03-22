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
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .sidebar-color {
            background-color: #272780;
        }

        .sidebar-item-color {
            color: #A9B5DF;
        }

        .sidebar-item-color:hover {
            background-color: #A9B5DF;
            color: #FFFFFF; 
        }
    </style>

    @yield('styles') 

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar-color sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            
                <div class="text-center sidebar-brand-text"  style="text-transform: none;">
                    <h3 class="welcome-text font-weight-bold">Welcome, Admin</h3>
                </div>
               
            </a>

            

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Pengelolaan Barang</div>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link " href="{{('/rincianNamaBarang')}}">
                    <i class="fas fa-list"></i>
                    <span>Rincian Nama Barang</span>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBaru') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Asset Barang Baru</span>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBekas') }}">
                    <i class="fas fa-sync-alt"></i>
                    <span>Asset Barang Bekas</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Pengelolaan Keuangan</div>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="#">
                    <span>Keuangan SolveThink</span>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBaru') }}">
                    <span>Rincian Belanja</span>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBekas') }}">
                    <span>Penjualan Barang</span>
                </a>
            </li>

            <li class="nav-item sidebar-item-color">
                <a class="nav-link" href="{{ url('/rincianBarangBekas') }}">
                    <span>Penyewaan Barang</span>
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                       
                            <!-- Notification Icon -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" role="button">
                                    <i class="fas fa-bell"></i>
                                </a>
                            </li>

                            <!-- Message Icon -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" role="button">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - Urse Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span> -->
                                <i class="fas fa-user"></i>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{('/login')}}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SolveThink 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded " href="#page-top">
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
                    <a class="btn btn-primary" href="{{('/login')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @yield('scripts') 

</body>

</html>
