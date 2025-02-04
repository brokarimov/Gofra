<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>


        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/" class="brand-link">
                <img src="{{asset("admin/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset("admin/dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{auth()->check() ? auth()->user()->name : "Alexander Pierce"}}</a>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (auth()->user()->hasPermission('role.index'))
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-table"></i>
                                        <p>Role</p>
                                    </a>
                                </li>
                                @endif

                                @if (auth()->user()->hasPermission('user.index'))
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-table"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                                @endif

                                @if (auth()->user()->hasPermission('permission-group.index'))
                                <li class="nav-item">
                                    <a href="{{ route('permission-group.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-table"></i>
                                        <p>Permission Group</p>
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    HR
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (auth()->user()->hasPermission('department.index'))
                                <li class="nav-item">
                                    <a href="{{ route('department.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>Department</p>
                                    </a>
                                </li>

                                @endif
                                @if (auth()->user()->hasPermission('salary.index'))
                                <li class="nav-item">
                                    <a href="{{ route('salary.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>Salary</p>
                                    </a>
                                </li>
                                @endif

                                @if (auth()->user()->hasPermission('employee.index'))
                                <li class="nav-item">
                                    <a href="{{ route('employee.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>Employee</p>
                                    </a>
                                </li>
                                @endif
                                @if (auth()->user()->hasPermission('storage.index'))
                                <li class="nav-item">
                                    <a href="{{ route('storage.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>Storage</p>
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('logout')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset("admin/plugins/jquery/jquery.min.js")}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset("admin/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset("admin/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- ChartJS -->
    <script src="{{ asset("admin/plugins/chart.js/Chart.min.js")}}"></script>
    <!-- Sparkline -->
    <script src="{{ asset("admin/plugins/sparklines/sparkline.js")}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset("admin/plugins/jqvmap/jquery.vmap.min.js")}}"></script>
    <script src="{{ asset("admin/plugins/jqvmap/maps/jquery.vmap.usa.js")}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset("admin/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset("admin/plugins/moment/moment.min.js")}}"></script>
    <script src="{{ asset("admin/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset("admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
    <!-- Summernote -->
    <script src="{{ asset("admin/plugins/summernote/summernote-bs4.min.js")}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset("admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("admin/dist/js/adminlte.js")}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset("admin/dist/js/demo.js")}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset("admin/dist/js/pages/dashboard.js")}}"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements with class "select2"
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            // Re-initialize Select2 when modal is opened (fixes issue where it doesn't load properly)
            $('.modal').on('shown.bs.modal', function() {
                $(this).find('.select2').each(function() {
                    $(this).select2({
                        theme: 'bootstrap4'
                    });
                });
            });
        });
    </script>


</body>

</html>