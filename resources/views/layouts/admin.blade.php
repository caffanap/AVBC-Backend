<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title') Amikom Voley Ball Club
    </title>

    <link rel="stylesheet"
        href="{{ asset('assets/adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte') }}/plugins/summernote/summernote-bs4.min.css">
    <!-- iziToas -->
    <link rel="stylesheet" href="{{ asset('assets/vendor') }}/iziToast.css" />


    <style>
        .active {
            color: white !important;
            background-color: rgba(255, 255, 255, .1) !important;
        }

    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('admin/dashboard') }}" class="brand-link text-center">
                <span class="brand-text font-weight-light">Amikom Volley Ball Club</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="{{ url('admin/dashboard') }}" class="d-block">Hallo,
                            {{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                {{-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class=" nav-item">
                            <a href="{{ url('/admin/dashboard') }}"
                                class="{{ strpos(Route::currentRouteName(), 'admin.dashboard') === 0 ? 'active' : '' }} nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Main Menu</li>
                        <li class=" nav-item">
                            <a href="{{ url('/admin/angkatan') }}"
                                class="{{ strpos(Route::currentRouteName(), 'admin.angkatan') === 0 ? 'active' : '' }} nav-link">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Angkatan
                                </p>
                            </a>
                        </li>
                        <li class=" nav-item">
                            <a href="{{ url('/admin/dashboard') }}"
                                class="{{ strpos(Route::currentRouteName(), 'admin.kegiatan') === 0 ? 'active' : '' }} nav-link">
                                <i class="nav-icon fas fa-dice"></i>
                                <p>
                                    Kegiatan
                                </p>
                            </a>
                        </li>
                        <li class=" nav-item">
                            <a href="{{ url('/admin/dashboard') }}"
                                class="{{ strpos(Route::currentRouteName(), 'admin.kegiatan') === 0 ? 'active' : '' }} nav-link">
                                <i class="nav-icon fas fa-bullhorn"></i>
                                <p>
                                    Informasi
                                </p>
                            </a>
                        </li>
                        <li class=" nav-item">
                            <a href="{{ url('/admin/dashboard') }}"
                                class="{{ strpos(Route::currentRouteName(), 'admin.anggota') === 0 ? 'active' : '' }} nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Daftar Anggota
                                </p>
                            </a>
                        </li>
                        <li class=" nav-item">
                            <a href="{{ url('/admin/dashboard') }}"
                                class="{{ strpos(Route::currentRouteName(), 'admin.anggota') === 0 ? 'active' : '' }} nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Pendaftaran
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">Extra</li>
                        <li class=" nav-item">
                            <a href="{{ url('/admin/dashboard') }}"
                                class="{{ strpos(Route::currentRouteName(), 'admin.masukan') === 0 ? 'active' : '' }} nav-link">
                                <i class="nav-icon fas fa-comment"></i>
                                <p>
                                    Masukan
                                </p>
                            </a>
                        </li>
                        <li class=" nav-item">
                            <a href="{{ url('/admin/dashboard') }}"
                                class="{{ strpos(Route::currentRouteName(), 'admin.masukan') === 0 ? 'active' : '' }} nav-link">
                                <i class="nav-icon fas fa-info"></i>
                                <p>
                                    Faqs
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Akun</li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/change-password') }}" class="{{ strpos(Route::currentRouteName(), 'admin.change-password') === 0 ? 'active' : '' }} nav-link">
                                <i class="nav-icon fa fa-user-cog"></i>
                                <p>
                                    Ubah Password
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('auth/logout') }}" class="nav-link">
                                <i class="nav-icon fa fa-power-off"></i>
                                <p>
                                    Keluar Akun
                                    {{-- <span class="badge badge-info right">2</span> --}}
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/adminlte') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="{{ asset('assets/adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>
    <script src="{{ asset('assets/adminlte') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


    <!-- JQVMap -->
    <script src="{{ asset('assets/adminlte') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/adminlte') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/adminlte') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('assets/adminlte') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/adminlte') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('assets/adminlte') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/adminlte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/adminlte') }}/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{ asset('assets/adminlte') }}/dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="{{ asset('assets/adminlte') }}/dist/js/pages/dashboard.js"></script> -->

    @yield('script')
</body>

</html>
