<?php
require_once '_config/config.php';
if (!isset($_SESSION['id_user'])) {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
} else {
    $kategori = isset($_SESSION['kategori']) ? $_SESSION['kategori'] : '';
?>



    <!DOCTYPE html>
    <html dir="ltr" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
        <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
        <meta name="robots" content="noindex,nofollow">
        <title>GMIT Genesaret Danau Ina Lasiana</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/logo_gmit.png') ?>">
        <!-- Custom CSS -->
        <link href="<?= base_url('assets/libs/flot/css/float-chart.css') ?>" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= base_url('dist/css/style.min.css') ?>" rel="stylesheet">
        <!-- Data Datbeles -->
        <link href="<?= base_url('assets/libs/datatables/datatables.min.css') ?>" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    

<![endif]-->
    </head>

    <body>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            <header class="topbar" data-navbarbg="skin5">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <div class="navbar-header" data-logobg="skin5">

                        <!-- ============================================================== -->
                        <!-- Logo -->
                        <!-- ============================================================== -->
                        <a class="navbar-brand" href="index.html">
                            <!-- Logo icon -->
                            <?php
                            $kategori = isset($_SESSION['kategori']) ? $_SESSION['kategori'] : '';
                            ?>
                            <b class="logo-icon ps-2">
                                <span><?= $kategori ?></span><br>
                            </b>
                            <!-- Logo icon -->
                            <!-- <b class="logo-icon"> -->
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                            <!-- </b> -->
                            <!--End Logo icon -->
                        </a>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Toggle which is visible on mobile only -->
                        <!-- ============================================================== -->
                        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                        <ul class="navbar-nav float-start me-auto">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        </ul>
                        <!-- ============================================================== -->
                        <!-- Right side toggle and nav items -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav float-end">
                            <!-- ============================================================== -->
                            <!-- Comment -->
                            <!-- ============================================================== -->
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-bell font-24"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li> -->
                            <!-- ============================================================== -->
                            <!-- End Comment -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- Messages -->
                            <!-- ============================================================== -->

                            <!-- ============================================================== -->
                            <!-- End Messages -->
                            <!-- ============================================================== -->

                            <!-- ============================================================== -->
                            <!-- User profile and search -->
                            <!-- ============================================================== -->
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url('assets/images/users/1.jpg') ?>" alt="user" class="rounded-circle" width="31">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i>
                                        My Profile</a>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet me-1 ms-1"></i>
                                        My Balance</a>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email me-1 ms-1"></i>
                                        Inbox</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings me-1 ms-1"></i> Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                                    <div class="dropdown-divider"></div>
                                    <div class="ps-4 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded text-white">View Profile</a></div>
                                </ul>
                            </li> -->
                            <!-- ============================================================== -->
                            <!-- User profile and search -->
                            <!-- ============================================================== -->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar" data-sidebarbg="skin5">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav" class="pt-4">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('dashboard/index.php') ?>" aria-expanded="false">
                                    <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                                </a>
                            </li>

                            <?php if ($kategori === 'Kordinator' || $kategori === 'Admin') { ?>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('status_sosial_jemaat/data.php') ?>" aria-expanded="false">
                                        <i class="fas fa-database"></i><span class="hide-menu">Status Sosial Jemaat</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($kategori === 'Kordinator' || $kategori === 'Admin') { ?>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('kepala_keluarga/data.php') ?>" aria-expanded="false">
                                        <i class="fas fa-database"></i><span class="hide-menu">Data Kepala Keluarga</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($kategori === 'Ketua Majelis' || $kategori === 'Admin') { ?>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('jemaat/data.php') ?>" aria-expanded="false">
                                        <i class="fas fa-database"></i><span class="hide-menu">Data Jemaat</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($kategori === 'Ketua Majelis' || $kategori === 'Admin') { ?>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('majelis/data.php') ?>" aria-expanded="false">
                                        <i class="fas fa-database"></i><span class="hide-menu">Majelis</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($kategori === 'Admin') { ?>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('rayon/data.php') ?>" aria-expanded="false">
                                        <i class="fas fa-database"></i><span class="hide-menu">Data Rayon</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('pendeta/data.php') ?>" aria-expanded="false">
                                        <i class="fas fa-database"></i><span class="hide-menu">Data Pendeta</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('user/data.php') ?>" aria-expanded="false">
                                        <i class="fas fa-database"></i><span class="hide-menu">Data User</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('periode/data.php') ?>" aria-expanded="false">
                                        <i class="fas fa-database"></i><span class="hide-menu">Periode</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('kordinator/data.php') ?>" aria-expanded="false">
                                        <i class="fas fa-database"></i><span class="hide-menu">Kordinator</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('auth/logout.php') ?>" aria-expanded="false">
                                    <i class="fa fa-power-off me-1 ms-1"></i><span class="hide-menu">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">

            <?php } ?>