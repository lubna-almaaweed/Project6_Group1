<?php include 'include/header.php' ?>

<!--Page Title-->
<section class="page-title" style="background-image:url(images/sweets.jpg)">
    <div class="auto-container">
        <?php if (isset($_GET['id'])) {
            $sql  = "select store_name , store_id  from store where store_id= {$_GET['id']}";
            $cat = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            if ($_GET['id'] == $cat['store_id']) {
                echo ' <h1 style="color: #5fcac7;"> Product ' . $cat['store_name'] . ' </h1>';
                echo '<ul class="page-breadcrumb">
            <li><a href="index.php">home</a></li>
             <li>Products =>' . $cat['store_name'] . '</li>
        </ul>';
            }
        } else {
            echo ' <h1 style="color: #5fcac7;"> Products </h1>';
            echo '<ul class="page-breadcrumb">
            <li><a href="index.php">home</a></li>
            <li>Products</li>
        </ul>';
        }
        ?>
    </div>
</section>
<!--End Page Title-->

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

            <!--Content Side-->
            <div class="content-side col-lg-9 col-md-12 col-sm-12">
                <div class="our-shop">
                    <div class="shop-upper-box clearfix">

                        <div class="items-label">Showing all 12 results</div>
                        <div class="orderby">
                            <select name="orderby" class="sortby-select select2-offscreen">
                                <option value="popularity">Sort by popularity</option>
                                <option value="rating">Sort by average rating</option>
                                <option value="date">Sort by newness</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to low</option>
                            </select>
                        </div>
                    </div>

                    <div class="row clearfix">

                        <!-- Shop Item -->
                        <?php
                        if (isset($_GET['id'])) {
                            $sql  = "select store_id from store where store_id= {$_GET['id']}";
                            $store = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                            $storeId = $store['store_id'];
                            if ($_GET['id'] == $storeId) {
                                $query  = "select * from products  where store_id= $storeId and offer > 0";
                                // $image_source = $row['pro_img'];
                                $result2 = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    echo "<div class='shop-item col-lg-4 col-md-6 col-sm-12'>
                                                    <div class='inner-box'>
                                                        <div class='image-box'>
                                                            <div class='sale-tag'>sale!</div>
                                                            <figure class='image'><a href='shop-singleTest.php?product={$row['pro_id']}'>
                                                            <img src='images/catogary/{$row['pro_img']}' alt='' style='height: 17rem'></a></figure>
                                                            <div class='btn-box'><a href='shopping-cart.php'>Add to cart</a></div>
                                                        </div>
                                                        <div class='lower-content'>
                                                            <h4 class='name'><a href='shop-singleTest.php?product={$row['pro_id']}'>{$row['pro_name']}</a></h4>
                                                            <div class='rating'><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star light'></span></div>
                                                            <div class='price'><del>{$row['pro_price']}JD</del> {$row['offer']}JD</div>
                                                        </div>
                                                    </div>
                                                </div>";
                                }
                                $query1  = "select * from products where store_id= $storeId and offer = 0";
                                $result1 = mysqli_query($conn, $query1);
                                while ($row2 = mysqli_fetch_assoc($result1)) {
                                    echo "<div class='shop-item col-lg-4 col-md-6 col-sm-12'>
                                                    <div class='inner-box'>
                                                        <div class='image-box'>
                                                            <figure class='image'><a href='shop-singleTest.php?product={$row2['pro_id']}'><img src='images/catogary/{$row2['pro_img']}' alt=''></a></figure>
                                                            <div class='btn-box'><a href='shopping-cart.php'>Add to cart</a></div>
                                                        </div>
                                                        <div class='lower-content'>
                                                            <h4 class='name'><a href='shop-singleTest.php?product={$row2['pro_id']}'>{$row2['pro_name']}</a></h4>
                                                            <div class='rating'><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star light'></span></div>
                                                            <div class='price'> {$row2['pro_price']}JD</div>
                                                        </div>
                                                    </div>
                                                </div>";
                                }
                            }
                        } else {
                            $query  = "select * from products  where  offer > 0";
                            $result2 = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result2)) {
                                echo "<div class='shop-item col-lg-4 col-md-6 col-sm-12'>
                                                    <div class='inner-box'>
                                                        <div class='image-box'>
                                                            <div class='sale-tag'>sale!</div>
                                                            <figure class='image'><a href='shop-singleTest.php?product={$row['pro_id']}'>
                                                            <img src='images/catogary/{$row['pro_img']}' alt=''  style='height: 17rem'></a></figure>
                                                            <div class='btn-box'><a href='shopping-cart.php'>Add to cart</a></div>
                                                        </div>
                                                        <div class='lower-content'>
                                                            <h4 class='name'><a href='shop-singleTest.php?product={$row['pro_id']}'>{$row['pro_name']}</a></h4>
                                                            <div class='rating'><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star light'></span></div>
                                                            <div class='price'><del>{$row['pro_price']}JD</del> {$row['offer']}JD</div>
                                                        </div>
                                                    </div>
                                                </div>";
                            }
                            $query1  = "select * from products  where offer = 0";
                            $result1 = mysqli_query($conn, $query1);
                            while ($row2 = mysqli_fetch_assoc($result1)) {
                                echo "<div class='shop-item col-lg-4 col-md-6 col-sm-12'>
                                                    <div class='inner-box'>
                                                        <div class='image-box'>
                                                            <figure class='image'><a href='shop-singleTest.php?product={$row2['pro_id']}'><img src='images/catogary/{$row2['pro_img']}' alt=''  style='height: 17rem'></a></figure>
                                                            <div class='btn-box'><a href='shopping-cart.php'>Add to cart</a></div>
                                                        </div>
                                                        <div class='lower-content'>
                                                            <h4 class='name'><a href='shop-singleTest.php?product={$row2['pro_id']}'>{$row2['pro_name']}</a></h4>
                                                            <div class='rating'><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star light'></span></div>
                                                            <div class='price'> {$row2['pro_price']}JD</div>
                                                        </div>
                                                    </div>
                                                </div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!--Sidebar Side-->
            <div class="sidebar-side sticky-container col-lg-3 col-md-12 col-sm-12">
                <aside class="sidebar theiaStickySidebar">
                    <div class="sticky-sidebar">
                        <!-- Search Widget -->
                        <div class="sidebar-widget search-widget">
                            <form method="post" action="contact.php">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Search products…" required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>

                        <!-- Range Slider Widget -->
                        <div class="sidebar-widget rangeslider-widget">
                            <div class="widget-content">
                                <h3 class="widget-title">Price Filter</h3>

                                <div class="range-slider-one clearfix">
                                    <div class="price-range-slider"></div>
                                    <div class="clearfix">
                                        <div class="pull-left input-box">
                                            <div class="title">Price:</div>
                                            <div class="input"><input type="text" class="property-amount" name="field-name" readonly></div>
                                        </div>
                                        <div class="pull-right btn-box">
                                            <a href="#" class="theme-btn"><span class="btn-title">Filtter</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tags Widget -->
                        <div class="sidebar-widget tags-widget">
                            <h3 class="widget-title">Tags</h3>
                            <ul class="tag-list clearfix">
                                <li><a href="#">Bars</a></li>
                                <li><a href="#">Caramels</a></li>
                                <li><a href="#">Chocolate</a></li>
                                <li><a href="#">Fruit</a></li>
                                <li><a href="#">Nuts</a></li>
                                <li><a href="#">Toffees</a></li>
                                <li><a href="#">Top Rated</a></li>
                                <li><a href="#">Truffles</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<!--End Sidebar Page Container-->

<!-- Main Footer -->
<footer class="main-footer style-seven">
    <div class="shape_wrapper wave_up">
        <div class="shape_inner" style="background-image: url(https://via.placeholder.com/1920x600);">
            <div class="overlay"></div>
        </div>
    </div>

    <!--Widgets Section-->
    <div class="widgets-section">
        <div class="auto-container">
            <div class="row">
                <!--Footer Column-->
                <div class="footer-column col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget social-widget">
                        <div class="widget-title">
                            <h3>Our Contacts</h3>
                            <svg viewBox="0 0 850.4 410.3">
                                <path d="M351.6,300.8c45.5,20.8,90.4,42.8,136.4,62.5c23,9.8,43.7,15,68.7,16.8c24.2,1.7,26.9-11.4,47.7-17.2 c36.4-10.2,50.6,30.7,12.4,39.4c-47,10.7-90.1,11.7-135.8-5.3c-43.6-16.2-84-40.4-125.5-61.1c-19.3-9.6-41-21.4-63.2-19.4 c-25.3,2.3-48.4,14.1-74.3,15.3c-33.4,1.5-101.6-4.4-107.8-47.3c-8-55.4,62.8-44,94.4-37.5c27.8,5.7,54.3,16.5,81.9,22 c27.9,5.7,49.2-4.2,74.5-15.3c49.2-21.6,108.5-37,152.6-67.4c-73-44.3-144.1-91.2-222.1-126.4c-68.4-30.9-157.2-64-226-12.7 c-11.1,8.3-20.3,19.6-26,32.2c-6.4,14-2.7,29.4-7.8,42.9C27.4,133.4,16,141,4.9,129.5c-10.1-10.4-2-33.4,2.1-44.6 C28.2,27.4,86.9,0.5,145,0c78.1-0.7,153.1,31.3,222.4,64.4c35.5,16.9,70.1,35.7,103.2,56.8c30.6,19.5,61.9,54.4,100.8,39.3 c68.6-26.4,131.4-75.9,210-57.7c57.6,13.4,99.3,84.7,40.5,125.7c-32.5,22.7-74.6,30.1-113.6,30c-42.6-0.1-77.9-19.1-117-32.7 c-41.5-14.4-84.9,10.2-124.1,24.2C448.9,256.6,351.9,281.1,351.6,300.8z M604.7,191.1c24.8,28.8,71.1,34.9,107.4,34.4 c31.8-0.4,94.3-7.9,110.4-41.2c23.9-49.5-49.1-56-77.9-51.8C695.1,139.9,649,169.4,604.7,191.1z M131.1,283.8 c25.5,27.4,91,30.7,122.6,7.1C212.6,263.8,153.1,259.8,131.1,283.8z"></path>
                            </svg>
                        </div>

                        <div class="text-box">
                            <p>250 Biscayne Blvd. (North) 11st Floor <br>New World Tower Miami, Florida 33148</p>
                            <p><a href="tel:305-333-5522">(305) 333-5522</a></p>
                            <p><a href="mailto:info@your-site.com">info@your-site.com</a></p>
                        </div>

                        <div class="social-box">
                            <ul class="social-icon-two">
                                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                <li><a href="#"><span class="fab fa-dribbble"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--Footer Column-->
                <div class="footer-column col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget gallery-widget">
                        <div class="widget-title">
                            <h3>Made For You</h3>
                            <svg viewBox="0 0 850.4 410.3">
                                <path d="M351.6,300.8c45.5,20.8,90.4,42.8,136.4,62.5c23,9.8,43.7,15,68.7,16.8c24.2,1.7,26.9-11.4,47.7-17.2 c36.4-10.2,50.6,30.7,12.4,39.4c-47,10.7-90.1,11.7-135.8-5.3c-43.6-16.2-84-40.4-125.5-61.1c-19.3-9.6-41-21.4-63.2-19.4 c-25.3,2.3-48.4,14.1-74.3,15.3c-33.4,1.5-101.6-4.4-107.8-47.3c-8-55.4,62.8-44,94.4-37.5c27.8,5.7,54.3,16.5,81.9,22 c27.9,5.7,49.2-4.2,74.5-15.3c49.2-21.6,108.5-37,152.6-67.4c-73-44.3-144.1-91.2-222.1-126.4c-68.4-30.9-157.2-64-226-12.7 c-11.1,8.3-20.3,19.6-26,32.2c-6.4,14-2.7,29.4-7.8,42.9C27.4,133.4,16,141,4.9,129.5c-10.1-10.4-2-33.4,2.1-44.6 C28.2,27.4,86.9,0.5,145,0c78.1-0.7,153.1,31.3,222.4,64.4c35.5,16.9,70.1,35.7,103.2,56.8c30.6,19.5,61.9,54.4,100.8,39.3 c68.6-26.4,131.4-75.9,210-57.7c57.6,13.4,99.3,84.7,40.5,125.7c-32.5,22.7-74.6,30.1-113.6,30c-42.6-0.1-77.9-19.1-117-32.7 c-41.5-14.4-84.9,10.2-124.1,24.2C448.9,256.6,351.9,281.1,351.6,300.8z M604.7,191.1c24.8,28.8,71.1,34.9,107.4,34.4 c31.8-0.4,94.3-7.9,110.4-41.2c23.9-49.5-49.1-56-77.9-51.8C695.1,139.9,649,169.4,604.7,191.1z M131.1,283.8 c25.5,27.4,91,30.7,122.6,7.1C212.6,263.8,153.1,259.8,131.1,283.8z"></path>
                            </svg>
                        </div>

                        <div class="instagram-gallery">
                            <div class="outer-box clearfix">
                                <figure class="image"><a href="https://via.placeholder.com/150x150" class="lightbox-image" data-fancybox='instagram'><img src="https://via.placeholder.com/150x150" alt=""></a></figure>

                                <figure class="image"><a href="https://via.placeholder.com/150x150" class="lightbox-image" data-fancybox='instagram'><img src="https://via.placeholder.com/150x150" alt=""></a></figure>

                                <figure class="image"><a href="https://via.placeholder.com/150x150" class="lightbox-image" data-fancybox='instagram'><img src="https://via.placeholder.com/150x150" alt=""></a></figure>

                                <figure class="image"><a href="https://via.placeholder.com/150x150" class="lightbox-image" data-fancybox='instagram'><img src="https://via.placeholder.com/150x150" alt=""></a></figure>

                                <figure class="image"><a href="https://via.placeholder.com/150x150" class="lightbox-image" data-fancybox='instagram'><img src="https://via.placeholder.com/150x150" alt=""></a></figure>

                                <figure class="image"><a href="https://via.placeholder.com/150x150" class="lightbox-image" data-fancybox='instagram'><img src="https://via.placeholder.com/150x150" alt=""></a></figure>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Footer Column-->
                <div class="footer-column col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget contact-widget">
                        <div class="widget-title">
                            <h3>Order Your Sweet</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 850.4 410.3">
                                <path d="M351.6,300.8c45.5,20.8,90.4,42.8,136.4,62.5c23,9.8,43.7,15,68.7,16.8c24.2,1.7,26.9-11.4,47.7-17.2 c36.4-10.2,50.6,30.7,12.4,39.4c-47,10.7-90.1,11.7-135.8-5.3c-43.6-16.2-84-40.4-125.5-61.1c-19.3-9.6-41-21.4-63.2-19.4 c-25.3,2.3-48.4,14.1-74.3,15.3c-33.4,1.5-101.6-4.4-107.8-47.3c-8-55.4,62.8-44,94.4-37.5c27.8,5.7,54.3,16.5,81.9,22 c27.9,5.7,49.2-4.2,74.5-15.3c49.2-21.6,108.5-37,152.6-67.4c-73-44.3-144.1-91.2-222.1-126.4c-68.4-30.9-157.2-64-226-12.7 c-11.1,8.3-20.3,19.6-26,32.2c-6.4,14-2.7,29.4-7.8,42.9C27.4,133.4,16,141,4.9,129.5c-10.1-10.4-2-33.4,2.1-44.6 C28.2,27.4,86.9,0.5,145,0c78.1-0.7,153.1,31.3,222.4,64.4c35.5,16.9,70.1,35.7,103.2,56.8c30.6,19.5,61.9,54.4,100.8,39.3 c68.6-26.4,131.4-75.9,210-57.7c57.6,13.4,99.3,84.7,40.5,125.7c-32.5,22.7-74.6,30.1-113.6,30c-42.6-0.1-77.9-19.1-117-32.7 c-41.5-14.4-84.9,10.2-124.1,24.2C448.9,256.6,351.9,281.1,351.6,300.8z M604.7,191.1c24.8,28.8,71.1,34.9,107.4,34.4 c31.8-0.4,94.3-7.9,110.4-41.2c23.9-49.5-49.1-56-77.9-51.8C695.1,139.9,649,169.4,604.7,191.1z M131.1,283.8 c25.5,27.4,91,30.7,122.6,7.1C212.6,263.8,153.1,259.8,131.1,283.8z"></path>
                            </svg>
                        </div>

                        <div class="footer-form">
                            <form action="#" method="post" id="email-form">
                                <div class="form-group">
                                    <div class="response"></div>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="username" class="username" placeholder="Your Name *">
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" class="email" placeholder="Your Email *">
                                </div>

                                <div class="form-group">
                                    <textarea name="contact_message" placeholder="Text Message"></textarea>
                                </div>

                                <div class="form-group">
                                    <button class="theme-btn" type="button" id="submit" name="submit-form">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Footer Bottom-->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="copyright-text">
                <p>Bellaria - A Delicious Cakes and Bakery WordPress Theme</p>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

</div><!-- End Page Wrapper -->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="php">
    <svg viewBox="0 0 500 500">
        <path d="M488.5,274.5L488.5,274.5l1.8-0.5l-2,0.5c-2.4-8.7-4.5-16.9-4.5-24.5c0-8,2.3-16.5,4.7-25.5
        c3.5-13,7.1-26.5,3.7-39.5c-3.6-13.2-13.5-23.1-23.1-32.7c-6.5-6.5-12.6-12.6-16.6-19.4c-3.9-6.8-6.1-15.2-8.5-24.1
        c-3.5-13.1-7.1-26.7-16.7-36.3c-9.5-9.5-22.9-13.1-35.9-16.6c-9-2.4-17.5-4.6-24.4-8.7c-6.5-3.8-12.5-9.8-18.9-16.2
        c-9.7-9.8-19.6-19.8-33.2-23.4c-13.5-3.7-27.3,0.1-40.4,3.7c-8.7,2.4-16.9,4.6-24.5,4.6c-8,0-16.5-2.3-25.5-4.7
        c-9.3-2.5-18.8-5-28.1-5c-3.8,0-7.6,0.4-11.3,1.4C172,11.1,162,21.1,152.4,30.7c-6.5,6.5-12.6,12.6-19.4,16.6
        c-6.8,3.9-15.2,6.1-24.1,8.5c-13.1,3.5-26.7,7.1-36.3,16.7c-9.5,9.5-13.1,23-16.6,36c-2.4,9-4.6,17.5-8.7,24.4
        c-3.8,6.5-9.8,12.5-16.2,18.9c-9.8,9.7-19.7,19.6-23.4,33.2c-3.7,13.5,0.1,27.3,3.7,40.5c2.4,8.7,4.6,16.9,4.6,24.5
        c0,8-2.3,16.5-4.6,25.5c-3.5,13-7.1,26.6-3.7,39.5c3.6,13.2,13.5,23.1,23.1,32.7c6.5,6.5,12.6,12.6,16.6,19.4
        c3.9,6.8,6.1,15.1,8.5,24c3.5,13.1,7.1,26.8,16.7,36.4c9.5,9.5,23,13.1,35.9,16.6c9,2.4,17.5,4.6,24.4,8.7
        c6.5,3.8,12.5,9.8,18.9,16.2c9.7,9.8,19.6,19.8,33.2,23.5c3.8,1,7.6,1.5,11.8,1.5c9.6,0,19.3-2.7,28.5-5.1c8.8-2.4,17-4.6,24.5-4.6 c8,0,16.5,2.3,25.5,4.6c13,3.6,26.6,7.1,39.5,3.7c13.2-3.6,23.1-13.5,32.7-23.1c6.5-6.5,12.6-12.6,19.4-16.6 c6.7-3.9,15.1-6.1,24-8.5c13.1-3.5,26.8-7.1,36.4-16.8c9.5-9.5,13.1-23,16.6-36c2.4-9,4.6-17.5,8.7-24.4c3.8-6.5,9.8-12.5,16.2-18.9 c9.8-9.7,19.9-19.7,23.6-33.3C495.7,301.4,494.4,287.7,488.5,274.5z"></path>
    </svg>
    <span class="fa fa-angle-up"></span>
</div>

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/appear.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/sticky_sidebar.min.js"></script>
<script src="js/script.js"></script>
</body>

</php>