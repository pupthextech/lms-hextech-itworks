<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }} | Library Management System</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ URL::asset('assets/adminlte/dist/css/adminlte.min.css') }}">

        @yield('styles')
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ URL::to('dashboard') }}" class="nav-link">Home</a>
            </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ URL::to('logout') }}" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ URL::to('dashboard') }}" class="brand-link">
            {{-- <img src="{{ URL::asset('assets/adminlte/dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Library MS</span> --}}
                <img src="{{ URL::asset('assets/adminlte/dist/img/adminltewhite.png') }}" alt="" class="img-fluid">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img src="{{ URL::asset('uploads/profile/'.Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="{{ URL::to('profile/'.Auth::user()->stud_number) }}" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ URL::to('dashboard') }}" class="nav-link @if($active_page == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                        </a>
                    </li>
                    {{-- Books for admin --}}
                    @if(Auth::user()->role == 'admin')
                        @php $bookPages = ['adminbooks', 'adminauthors', 'admincategories']; @endphp
                        <li class="nav-item @if(in_array($active_page,$bookPages)) menu-open @endif">
                            <a href="#" class="nav-link @if(in_array($active_page,$bookPages)) active @endif">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Books
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ URL::to('admin/books') }}" class="nav-link @if($active_page == 'adminbooks') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Book List
                                    </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to('admin/authors') }}" class="nav-link @if($active_page == 'adminauthors') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Author List
                                    </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to('admin/categories') }}" class="nav-link @if($active_page == 'admincategories') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Category List
                                    </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('admin/users') }}" class="nav-link @if($active_page == 'users') active @endif"
                            ><i class="nav-icon fas fa-user"></i>
                            <p>
                                Users
                            </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('admin/book_issues') }}" class="nav-link @if($active_page == 'bookIssues') active @endif"
                            >
                            <i class="nav-icon fas fa-id-card-alt"></i>
                            <p>
                                Issue Book
                            </p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content-header')
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        {{-- <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer> --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ URL::asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ URL::asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ URL::asset('assets/adminlte/dist/js/adminlte.min.js') }}"></script>

        @yield('scripts')
    </body>
</html>
