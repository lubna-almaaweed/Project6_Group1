<?php

include 'include/header.php';

?>


<!--Page Title-->
<section class="page-title" style="background-image:url('images/bk21.jpg')">
    <?php
    if (isset($_GET['product'])) {
        $proID = $_GET['product'];
        $sql  = "SELECT * FROM products  WHERE  $proID = products.pro_id";
        $products = mysqli_query($conn, $sql);
        while ($pro = mysqli_fetch_assoc($products)) {
            echo "
    <div class='auto-container'>
    <h1>{$pro['pro_name']}</h1>
    <ul class='page-breadcrumb'>
        <li><a href='index.php'>home</a></li>
        <li><a href='shop.php'>Products</a></li>
        <li>{$pro['pro_name']}</li>
    </ul>
     </div>
    ";
        }
    } ?>



</section>
<!--Sidebar Page Container-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

            <!--Content Side-->
            <div class="content-side col-lg-9 col-md-12 col-sm-12">
                <div class="shop-single">

                    <!-- Product Detail -->
                    <div class="product-details">
                        <!--Basic Details-->
                        <div class="basic-details">
                            <div class="row clearfix">

                                <?php
                                if (isset($_GET['product'])) {
                                    $proID = $_GET['product'];
                                    $sql  = "SELECT * FROM products  WHERE  $proID = products.pro_id";
                                    $products = mysqli_query($conn, $sql);
                                    while ($pro = mysqli_fetch_assoc($products)) {
                                        $IdProd = $pro['pro_id'];
                                        $Price = $pro['pro_price']; ?>

                                        <div class='image-column col-md-6 col-sm-12'>
                                            <figure class='image'>
                                                <?php echo  "<img src='images/catogary/{$pro['pro_img']}' alt=''  style='height: 17rem'>"; ?>

                                            </figure>
                                        </div>
                                        <div class='info-column col-md-6 col-sm-12'>
                                            <div>
                                                <div class='details-header'>
                                                    <?php echo "<h4>{$pro['pro_name']}</h4>" ?>
                                                    <div class='rating'>
                                                        <span class='fa fa-star'></span>
                                                        <span class='fa fa-star'></span>
                                                        <span class='fa fa-star'></span>
                                                        <span class='fa fa-star'></span>
                                                        <span class='fa fa-star'></span>
                                                    </div>
                                                    <a class='reviews' href='#'>(2 Customer Reviews)</a>
                                                    <br>
                                                    <?php
                                                    if ($pro['is_off'] == "true") {
                                                        echo "   <h5 style='text-decoration-line: line-through;'> Price: {$pro['pro_price']} JD</h5>
                                                    <br> <h5 style='color:#ff91a4;'>
                                                      Offer Price: {$pro['offer']}JD </h5>";
                                                        $myPrice = $pro['offer'];
                                                    } else {
                                                        echo "
                                                        <h5 style='color:#ff91a4;'> Price: {$pro['pro_price']} JD </h5>";
                                                        $myPrice = $pro['pro_price'];
                                                    }
                                                    ?>
                                                    <br>
                                                    <div class='text'>Accumsan lectus, consectetuer
                                                        et sagittis et commodo, massa et, sed facilisi mi, sit diam.
                                                        Ultrices facilisi convallis nullam duis. Aliquam lacinia orci
                                                        convallis erat ac, vitae neque in class.
                                                    </div>
                                                </div>

                                                <form action="shopping-cart.php" method='get'>
                                                    <div class='other-options clearfix'>
                                                        <div class='item-quantity'>Quantity
                                                            <input name="quantity" min=1 type="number" id='quantity' class="qty" value="<?php echo $pro_qty; ?>">
                                                            <input name="price" type="hidden" value="<?php echo $pro['pro_price']; ?>">
                                                        </div>
                                                        <button type="submit" name="product" class="theme-btn add-to-cart" value="<?php echo $pro['pro_id']; ?>">Add to cart</button>
                                                    </div>

                                                </form>
                                            <?php
                                        }; ?>
                                            </div>
                                        </div>
                                    <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--End Page Title-->

<?php include 'include/footer.php' ?>