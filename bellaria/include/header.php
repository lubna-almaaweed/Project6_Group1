<?php
require 'connection.php';
session_start();

//عشان لما يصير تعديل على الاسم يتعدل 
if (isset($_SESSION['isLogin'])) {
    $sql = "SELECT * from users where user_id={$_SESSION['use']['user_id']}";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $_SESSION['use']['fullname'] = $row['fullname'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Te7lay</title>

    <!-- Stylesheets -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="plugins/revolution/css/settings.css" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
    <link href="plugins/revolution/css/layers.css" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
    <link href="plugins/revolution/css/navigation.css" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader">
            <div class="loader_overlay"></div>
            <div class="loader_cogs">
                <div class="loader_cogs__top">
                    <div class="top_part"></div>
                    <div class="top_part"></div>
                    <div class="top_part"></div>
                    <div class="top_hole"></div>
                </div>
                <div class="loader_cogs__left">
                    <div class="left_part"></div>
                    <div class="left_part"></div>
                    <div class="left_part"></div>
                    <div class="left_hole"></div>
                </div>
                <div class="loader_cogs__bottom">
                    <div class="bottom_part"></div>
                    <div class="bottom_part"></div>
                    <div class="bottom_part"></div>
                    <div class="bottom_hole"></div>
                </div>
            </div>
        </div>

        <!-- Main Header-->
        <header class="main-header">
            <!-- Menu Wave -->
            <div class="menu_wave"></div>

            <!-- Main box -->
            <div class="main-box">
                <div class="menu-box">
                    <div class="logo"><a href="index.php"><img src="images/sd.png" alt="" title="" style="width: 12vw;"></a></div>

                    <!--Nav Box-->
                    <div class="nav-outer clearfix">
                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation menu-left clearfix">
                                    <li class="current dropdown"><a href="index.php">Home</a>

                                    </li>
                                </ul>
                                <ul class="navigation menu-right clearfix">
                                    <li class="dropdown"><a href="catogery.php">Category</a>
                                        <ul>
                                            <?php
                                            $query  = "select * from category";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '  <li><a href="catogery.php?id=' . $row['cat_id'] . '&type=' . $row['cat_name'] . '" >' . $row['cat_name'] . '</a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="store.php">Stores</a>
                                        <ul>
                                            <?php
                                            $query  = "select * from store";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<li><a href="store.php?id=' . $row['store_id'] . '&type=' . $row['store_name'] . '">' . $row['store_name'] . '</a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->

                        <div class="outer-box clearfix">
                            <!-- login /Register Car -->
                            <div class="cart-btn" style="margin-right: 1rem;">
                                <a href="signin.php"><i class="fas fa-user-circle" style="font-size: 1.5rem;"></i></a>
                                <div class="shopping-cart">
                                    <?php if (isset($_SESSION['isLogin'])) { ?>
                                        <?php echo 'Hello ' . $_SESSION['use']['fullname']; ?>
                                        <ul class="shopping-cart-items">
                                            <li class="cart-item">
                                                <a href="profile_page.php" class="product-detail" style="font-size: 1.5em;"> <i class="fas fa-user-alt mx-3"></i>Profile</a>
                                            </li>

                                            <li class="cart-item">
                                                <a href="logout.php" class="product-detail" style="font-size: 1.5em;"><i class="fas fa-id-card-alt mx-3"></i> Logout</a>
                                            </li>
                                        </ul>

                                    <?php } else {   ?>
                                        <ul class="shopping-cart-items">
                                            <li class="cart-item">
                                                <a href="signin.php" class="product-detail" style="font-size: 1.5em;"> <i class="fas fa-user-alt mx-3"></i>Login</a>
                                            </li>

                                            <li class="cart-item">
                                                <a href="register.php" class="product-detail" style="font-size: 1.5em;"><i class="fas fa-id-card-alt mx-3"></i> Register</a>
                                            </li>
                                        </ul>
                                    <?php   }  ?>
                                </div>
                                <!--end shopping-cart -->
                            </div>


                            <!-- Shoppping Car -->
                            <!-- <div class="cart-btn">
                                <a href="shopping-cart.php"><i class="icon flaticon-commerce" style="font-size: 1.5rem;"></i> <span class="count">2</span></a>

                            </div> -->

                            <div class="cart-btn">
                                <?php
                                $sql  = "SELECT * FROM order_details ";
                                $products = mysqli_query($conn, $sql);
                                if (isset($products)) {
                                    $counter = 0;
                                    while ($pro = mysqli_fetch_assoc($products)) {
                                        $counter += 1;
                                    }
                                }
                                ?>
                                <a href="shopping-cart.php"><i class="icon flaticon-commerce" style="font-size: 1.5rem;"></i> <span class="count"><?php echo $counter; ?></span></a>
                            </div>

                            <!-- Search Btn -->
                            <div class="search-box">
                                <button class="search-btn"><i class="fa fa-search" style="font-size: 1.5rem;"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Header  -->
            <div class="sticky-header">
                <div class="auto-container clearfix">
                    <!--Logo-->
                    <div class="logo">
                        <a href="#" title="Sticky Logo"><img src="images/logo-small1.png" alt="Sticky Logo" style="height: 4rem;"></a>
                    </div>

                    <!--Nav Outer-->
                    <div class="nav-outer">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav><!-- Main Menu End-->
                    </div>
                </div>
            </div><!-- End Sticky Menu -->

            <!-- Mobile Header -->
            <div class="mobile-header">
                <div class="logo"><a href="index.php"><img src="images/logo-small1.png" alt="" title="" style="height: 4rem;"></a></div>

                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </div>
            </div>

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <nav class="menu-box">
                    <div class="nav-logo"><a href="index.php"><img src="images/logo-small1.png" alt="" title="" style="height: 4rem;"></a></div>
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                </nav>
            </div><!-- End Mobile Menu -->

            <!-- Header Search -->
            <div class="search-popup">
                <span class="search-back-drop"></span>

                <div class="search-inner">
                    <button class="close-search"><span class="fa fa-times"></span></button>
                    <form method="post" action="blog-showcase.html">
                        <div class="form-group">
                            <input type="search" name="search-field" value="" placeholder="Search..." required="">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Header Search -->

        </header>
        <!--End Main Header -->