<?php include 'include/header.php';
if (isset($_GET['quantity'])) {
    // fetch data from form                                        
    $pro_qty = $_GET['quantity'];
    $pro_id = $_GET['product'];
    $myPrice = $_GET['price'];
    $totalQty = $pro_qty * $myPrice;



    $proSql = "INSERT INTO order_details(pro_qty,total,pro_id)
                 values('{$pro_qty}','{$totalQty}','{$pro_id}') ";
    mysqli_query($conn, $proSql);

?>
    <script>
        window.open('shopping-cart.php');
        window.close();
    </script>

<?php
}

if (isset($_GET['update'])) {
    $query  = "select * from order_details where o_d_id = {$_GET['odid']}";
    $result = mysqli_query($conn, $query);
    $row    = mysqli_fetch_assoc($result);

    $query = "delete from order_details where o_d_id = {$_GET['odid']}";
    mysqli_query($conn, $query);

    $proSql = "INSERT INTO order_details( o_d_id,pro_qty,total,pro_id)
    values('{$row['o_d_id']}','{$_GET['newquantity']}','{$row['total']}','{$row['pro_id']}') ";
    mysqli_query($conn, $proSql);
?>
    <script>
        window.open('shopping-cart.php');
        window.close();
    </script>

<?php
}


if (isset($_GET['delid'])) {
    $query = "delete from order_details where o_d_id = {$_GET['delid']}";
    mysqli_query($conn, $query);
?>
    <script>
        window.open('shopping-cart.php');
        window.close();
    </script>
<?php
}


?>



<!--Page Title-->
<section class="page-title" style="background-image:url('images/bg.jpg')">
    <div class="auto-container">
        <h1>Cart</h1>
        <ul class="page-breadcrumb">
            <li><a href=index.php>home</a></li>
            <li>Cart</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!--Cart Section-->
<section class="cart-section">
    <div class="auto-container">
        <!--Cart Outer-->
        <div class="cart-outer">
            <div class="table-outer">
                <table class="cart-table">
                    <thead class="cart-header">
                        <tr>
                            <th class="product-name">Product Image</th>
                            <th class="product-name">Product</th>
                            <th class="product-name">Quantity</th>
                            <th class="product-price">Price</th>
                            <th class="product-price">Total</th>
                            <th class="product-price">Delete</th>
                            <th class="product-price">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql  = "SELECT * FROM order_details ";
                        $products = mysqli_query($conn, $sql);
                        if (isset($products)) {
                            $total = 0;
                            $counter = 0;
                            while ($pro = mysqli_fetch_assoc($products)) {
                                $counter += 1;
                                $sql  = "SELECT * FROM products WHERE pro_id = {$pro['pro_id']}";
                                $product = mysqli_query($conn, $sql);
                                $one_pro = mysqli_fetch_assoc($product);
                                $one_total = $one_pro['pro_price'] * $pro['pro_qty'];
                                $total += $one_total;
                                echo "
                                <tr>
                                <td><img src='../admin/images/{$one_pro['pro_img']}' width='200rem'></td>
                                    <td><a href='#'>{$one_pro['pro_name']}</a></td>";

                                if (isset($_GET['up']) && $_GET['up'] == $counter) {

                                    echo "
                                    <td>
                                    
                                    <form action='shopping-cart.php' method='get'>
                                    <div >
                                        <div'>
                                            <input placeholder='New quantity' name='newquantity' min=1 type='number' id='quantity' class='text-info' value=' {$pro['pro_qty']}'>
                                            <input name='odid' class='btn  btn-outline-info' type='hidden' value='{$pro['o_d_id']}'>
                                        </div>
                                        <button type='submit' name='update' class='btn btn-info' value='{$pro['pro_id']}'>set</button>
                                    </div>

                                </form>
                                       
                                        </td>";
                                } else {
                                    echo " <td><h2 class='td-color'>{$pro['pro_qty']}</h2></td>";
                                }
                                echo "
                                    <td><h2 class='td-color'>{$one_pro['pro_price']}JD</h2></td>
                                    <td><h2 class='td-color'>" .  $one_total . "JD</h2></td>
                                    <td><a href='shopping-cart.php?delid={$pro['o_d_id']}' class='btn btn-danger'>Delete</a></td>
                                    <td><a href='shopping-cart.php?up={$counter}' class='btn btn-success'>Update</a></td>
                                </tr>
                                ";
                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-between">
                <div class="column col-lg-4 offset-lg-8 col-md-6 col-sm-12">
                    <!--Totals Table-->
                    <ul class="totals-table">
                        <li>
                            <h3>Cart Totals</h3>
                            <h3> <?php echo $total; ?> </h3>
                        </li>
                        <?php if (!isset($_SESSION['isLogin'])) {

                            echo ' <li class="text-right"><button type="submit" class="theme-btn proceed-btn">

                                <a href="signin.php"> Proceed to Checkout</a></button></li>';
                        } else {
                            echo '<li class="text-right">
                                  <button type="submit" class="theme-btn proceed-btn">
                                  <a href="profile_page.php">Proceed to Checkout</a> </button></li>
                                
                                ';

                        } ?>
                    </ul>
                </div>
            </div>
        </div>
</section>
<!--End Cart Section-->

<?php include 'include/footer.php' ?>