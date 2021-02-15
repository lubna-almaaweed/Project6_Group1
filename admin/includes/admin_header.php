<?php
session_start();
if (!$_SESSION['admin_id']) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <style>
        .center {
            display: grid !important;
            place-items: center !important;
        }

        .margin {
            margin: 0 auto;
            width: fit-content;
        }

        .rem10 {
            width: 10rem;
        }
    </style>
</head>


<body class="animsition">
    <div class="page-wrapper ">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none center ">
            <div class="header-mobile__bar center">
                <div class="container-fluid center">
                    <div class="header-mobile-inner rem10">
                        <a class="logo" href="manage_admin.php">
                            <!-- <img src="images/sd.png" alt="CoolAdmin" /> -->
                            <!-- <p>logo</p> -->
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile rem10">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="Manage_Stors.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage Stores</a>
                        </li>
                        <li>
                            <a href="manage_admin.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage Admin</a>
                        </li>
                        <li>
                            <a href="Manage_Category.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage Category</a>
                        </li>
                        <li>
                            <a href="Manage_products.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage products</a>
                        </li>
                        <li>
                            <a href="manage_users.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage users</a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="manage_admin.php">
                    <img src="images/sd.png" alt="Cool Admin" style="width: 7vw;" />
                    <!-- <p>logo</p> -->

                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="Manage_Stors.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage Stores</a>
                        </li>
                        <li>
                            <a href="manage_admin.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage Admin</a>
                        </li>
                        <li>
                            <a href="Manage_Category.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage Category</a>
                        </li>
                        <li>
                            <a href="Manage_products.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage products</a>
                        </li>
                        <li>
                            <a href="manage_users.php" style="color: #5fcac7;">
                                <i class="fas fa-chart-bar"></i>Manage users</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header style="display: grid; place-items: center;" class="header-desktop  ">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">

                            <div class="header-button margin center">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">

                                        <div class="content rem10">
                                            <a class="js-acc-btn" href="#" style="color: #5fcac7;"><?php echo $_SESSION['admin_name']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">

                                            <div class="account-dropdown__footer">
                                                <a href="logout.php" style="color: #5fcac7;">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->