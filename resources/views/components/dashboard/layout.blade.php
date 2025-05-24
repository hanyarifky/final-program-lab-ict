<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? "Dashboard" }} | Sistem Penjadwalan Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('image/remove-logo.png') }}">

    <!-- jquery.vectormap css -->
    <link href="{{ asset('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    

    <style>

        body.vertical-collpsed .logo-lg {
        width: 0 !important;
        height: 0 !important;
        opacity: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        overflow: hidden !important;
        pointer-events: none !important;
        transition: none !important;
        display: none !important;
        }

        .logo-sm img {
        height: 30px !important;
        width: auto !important;
        margin-bottom: 12px;
        }
    </style>
</head>

<body data-topbar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box d-flex align-items-center pt-2">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('images/logo-sm.png') }}" alt="logo-sm" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('images/logo-dark.png') }}" alt="logo-dark" height="20">
                            </span>
                        </a>

                        <a href="/dashboard" class="logo logo-light">
                            <span class="logo-sm">
                                <img class="rounded-circle" src="{{ asset('image/logo.jpeg') }}" alt="logo-light" height="30">
                            </span>
                            <span class="logo-lg d-flex">
                                <img class="rounded-circle" src="{{ asset('image/logo.jpeg') }}" alt="logo-light" height="30">
                                <h6 class="text-white text-start ms-2">Sistem Penjadwalan Lab ICT</h6>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="ri-menu-2-line align-middle"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="ri-search-line"></span>
                        </div>
                    </form>

                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-search-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="mb-3 m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-notification-3-line"></i>
                            <span class="noti-dot"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Notifications </h6>
                                    </div>
                                    {{-- <div class="col-auto">
                                        <a href="#!" class="small"> View All</a>
                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div data-simplebar style="max-height: 230px;">
                                @foreach (Auth::booking_kp() as $booking)
                                    
                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="ri-shopping-cart-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-1">Your order is placed</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">If several languages coalesce the grammar</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div> --}}
                            {{-- <div class="p-2 border-top">
                                <div class="d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="dropdown d-inline-block user-dropdown">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-xl-inline-block ms-1">{{ auth()->user()->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            {{-- <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a> --}}
                            <!-- Form logout tersembunyi -->
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <!-- Link logout yang memicu submit form -->
                            <a href="#" class="dropdown-item text-danger" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">
               <div id="sidebar-menu">
                        <!-- Left Menu Start -->    
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="/dashboard" class="waves-effect">
                                    <i class="ri-dashboard-line"></i>
                                    {{-- <span class="badge rounded-pill bg-success float-end">3</span> --}}
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="/dashboard/jadwal" class=" waves-effect">
                                    <i class="ri-calendar-2-line"></i>
                                    <span>Manage Jadwal</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);" class=" waves-effect has-arrow">
                                    <i class="ri-calendar-2-line"></i>
                                    <span>Manage Booking</span>
                                </a>

                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/dashboard/booking-kp">
                                        <i class="fas fa-user-graduate"></i>
                                        Kuliah Pengganti</a></li>
                                    {{-- <li><a href="icons-materialdesign.html">
                                        <i class="fas fa-desktop"></i>
                                        Peminjaman Lab</a></li> --}}
                                </ul>
                            </li>
                

                            <li class="menu-title">Manage Master</li>
                            <li>
                                <a href="/dashboard/dosen" class="waves-effect">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Data Dosen</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="/dashboard/matkul" class="waves-effect">
                                    <i class="fas fa-book"></i>
                                    <span>Data Mata Kuliah</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="/dashboard/kelas" class="waves-effect">
                                    <i class="fas fa-users"></i>
                                    <span>Data Kelas</span>
                                </a>
                            </li>

                            <li>
                                <a href="/dashboard/ruangan" class="waves-effect">
                                    <i class="fas fa-desktop"></i>
                                    <span>Data Ruangan</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

             <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><a href="#">{{ $title ?? ""}}</a></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Content here ... -->
                    {{ $slot }}

                </div>
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    {{-- JavaScript untuk tambah/hapus input detail dinamis --}}
    
    <!-- JAVASCRIPT -->
    @include('sweetalert2::index')
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{ asset('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        
        $(document).ready(function() {
            $('#datatable-buttons').DataTable({
                responsive: true
            });
        });

        
    </script>

</body>

</html>
