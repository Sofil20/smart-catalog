<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Catalog') }}</title>

    <!-- AdminLTE -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Overlay Scrollbar -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars/css/OverlayScrollbars.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">

    @stack('styles')

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link"
                    data-widget="pushmenu"
                    href="#"
                    role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('dashboard') }}"
                    class="nav-link">
                    Dashboard
                </a>
            </li>

        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown user-menu">

                <a href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown">

                    <img
                        src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                        class="user-image img-circle elevation-2"
                        alt="User">

                    <span class="d-none d-md-inline">

                        {{ Auth::user()->name }}

                    </span>

                </a>

                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    <li class="user-header bg-primary">

                        <img
                            src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                            class="img-circle elevation-2"
                            alt="User">

                        <p>

                            {{ Auth::user()->name }}

                            -

                            {{ ucfirst(Auth::user()->role) }}

                            <small>

                                Bergabung

                                {{ Auth::user()->created_at->format('d M Y') }}

                            </small>

                        </p>

                    </li>

                    <li class="user-footer">

                        <a href="{{ route('profile.edit') }}"
                            class="btn btn-default">

                            Profile

                        </a>

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="float-right">

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-default">

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </li>

        </ul>

    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="{{ route('dashboard') }}"
            class="brand-link">

            <img
                src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png"
                class="brand-image img-circle elevation-3"
                style="opacity:.8">

            <span class="brand-text font-weight-light">

                Smart Catalog

            </span>

        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="image">

                    <img
                        src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                        class="img-circle elevation-2">

                </div>

                <div class="info">

                    <a href="#"
                        class="d-block">

                        {{ Auth::user()->name }}

                    </a>

                </div>

            </div>
                        <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false">

                    @if(Auth::user()->role === 'admin')

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>Admin Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.merchants') }}"
                               class="nav-link {{ request()->routeIs('admin.merchants.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Merchant</p>
                            </a>
                        </li>

                        <li class="nav-header">
                            MASTER DATA
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}"
                               class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Kategori</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('products.index') }}"
                               class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-box"></i>
                                <p>Produk</p>
                            </a>
                        </li>

                        <li class="nav-header">
                            TRANSAKSI
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('stock-transactions.index') }}"
                               class="nav-link {{ request()->routeIs('stock-transactions.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Barang Masuk</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('sales-transactions.index') }}"
                               class="nav-link {{ request()->routeIs('sales-transactions.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>

                        <li class="nav-header">
                            LAPORAN
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.sales') }}"
                            class="nav-link {{ request()->routeIs('reports.sales') ? 'active' : '' }}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Laporan Penjualan</p>

                            </a>
                        </li>

                    @else

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        {{-- ================= MASTER DATA ================= --}}

                        <li class="nav-item has-treeview
                        {{ request()->routeIs('categories.*') || request()->routeIs('products.*') ? 'menu-open' : '' }}">

                            <a href="#"
                            class="nav-link {{ request()->routeIs('categories.*') || request()->routeIs('products.*') ? 'active' : '' }}">

                                <i class="nav-icon fas fa-folder"></i>

                                <p>

                                    Master Data

                                    <i class="right fas fa-angle-left"></i>

                                </p>

                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="{{ route('categories.index') }}"
                                    class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Kategori</p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a href="{{ route('products.index') }}"
                                    class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Produk</p>

                                    </a>

                                </li>

                            </ul>

                        </li>

                        {{-- ================= TRANSAKSI ================= --}}

                        <li class="nav-item has-treeview
                        {{ request()->routeIs('stock-transactions.*') || request()->routeIs('sales-transactions.*') ? 'menu-open' : '' }}">

                            <a href="#"
                            class="nav-link {{ request()->routeIs('stock-transactions.*') || request()->routeIs('sales-transactions.*') ? 'active' : '' }}">

                                <i class="nav-icon fas fa-cash-register"></i>

                                <p>

                                    Transaksi

                                    <i class="right fas fa-angle-left"></i>

                                </p>

                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="{{ route('stock-transactions.index') }}"
                                    class="nav-link {{ request()->routeIs('stock-transactions.*') ? 'active' : '' }}">

                                        <i class="fas fa-arrow-down nav-icon"></i>

                                        <p>Barang Masuk</p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a href="{{ route('sales-transactions.index') }}"
                                    class="nav-link {{ request()->routeIs('sales-transactions.*') ? 'active' : '' }}">

                                        <i class="fas fa-shopping-cart nav-icon"></i>

                                        <p>Penjualan</p>

                                    </a>

                                </li>

                            </ul>

                        </li>

                        {{-- ================= LAPORAN ================= --}}

                        <li class="nav-item has-treeview">

                            <a href="#"
                            class="nav-link">

                                <i class="nav-icon fas fa-file-alt"></i>

                                <p>

                                    Laporan

                                    <i class="right fas fa-angle-left"></i>

                                </p>

                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="{{ route('reports.sales') }}"
                                    class="nav-link {{ request()->routeIs('reports.sales') ? 'active' : '' }}">

                                        <i class="far fa-file nav-icon"></i>

                                        <p>Laporan Penjualan</p>

                                    </a>

                                </li>

                            </ul>

                        </li>

                    @endif

                </ul>

            </nav>

        </div>

    </aside>
        <!-- Content Wrapper -->
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1>
                            @yield('page-title', 'Dashboard')
                        </h1>
                    </div>

                </div>

            </div>
        </section>

        <section class="content">

            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </div>

        </section>

    </div>

    <!-- Footer -->
    <footer class="main-footer">

        <strong>

            &copy; {{ date('Y') }}
            Smart Catalog.

        </strong>

        All rights reserved.

        <div class="float-right d-none d-sm-inline-block">

            Version 1.0

        </div>

    </footer>

</div>

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7/dist/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- OverlayScrollbars -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars/js/OverlayScrollbars.min.js"></script>

<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@stack('scripts')

</body>
</html>