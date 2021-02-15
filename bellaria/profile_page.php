<?php include 'include/header.php' ?>
<?php
 if (!isset($_SESSION['isLogin'])) {
    header("location:index.php");} ?>
<?php {
    //Update Data 
    if (isset($_POST['user_id'])) {
        $user_name            = $_POST['user_name'];
        $user_email           = $_POST['user_email'];
        $user_password        = $_POST['user_password'];
        $query = "UPDATE users SET    fullname      = '$user_name',
                                         email         = '$user_email',
                                         password      = '$user_password'
                                         WHERE user_id = {$_POST['user_id']}";

        if (!mysqli_query($conn, $query)) {
            echo "Error: " . $query . "
                " . mysqli_error($conn);
        }
    }
}

?>
<!-- Call to Action -->
<section class="call-to-action">
    <div class="shape_wrapper shape_one">
        <div class="shape_inner shape_two" style="background-image: url(images/Slider/7.jpg);">
            <div class="overlay"></div>
        </div>
    </div>

    <div class="auto-container">
        <div class="content-box">
            <div class="icon-box">
                <div class="icon-frame"><svg x="0px" y="0px" viewBox="0 0 500 500">
                        <path d="M488.5,274.5L488.5,274.5l1.8-0.5l-2,0.5c-2.4-8.7-4.5-16.9-4.5-24.5c0-8,2.3-16.5,4.7-25.5 c3.5-13,7.1-26.5,3.7-39.5c-3.6-13.2-13.5-23.1-23.1-32.7c-6.5-6.5-12.6-12.6-16.6-19.4c-3.9-6.8-6.1-15.2-8.5-24.1 c-3.5-13.1-7.1-26.7-16.7-36.3c-9.5-9.5-22.9-13.1-35.9-16.6c-9-2.4-17.5-4.6-24.4-8.7c-6.5-3.8-12.5-9.8-18.9-16.2 c-9.7-9.8-19.6-19.8-33.2-23.4c-13.5-3.7-27.3,0.1-40.4,3.7c-8.7,2.4-16.9,4.6-24.5,4.6c-8,0-16.5-2.3-25.5-4.7 c-9.3-2.5-18.8-5-28.1-5c-3.8,0-7.6,0.4-11.3,1.4C172,11.1,162,21.1,152.4,30.7c-6.5,6.5-12.6,12.6-19.4,16.6 c-6.8,3.9-15.2,6.1-24.1,8.5c-13.1,3.5-26.7,7.1-36.3,16.7c-9.5,9.5-13.1,23-16.6,36c-2.4,9-4.6,17.5-8.7,24.4 c-3.8,6.5-9.8,12.5-16.2,18.9c-9.8,9.7-19.7,19.6-23.4,33.2c-3.7,13.5,0.1,27.3,3.7,40.5c2.4,8.7,4.6,16.9,4.6,24.5 c0,8-2.3,16.5-4.6,25.5c-3.5,13-7.1,26.6-3.7,39.5c3.6,13.2,13.5,23.1,23.1,32.7c6.5,6.5,12.6,12.6,16.6,19.4 c3.9,6.8,6.1,15.1,8.5,24c3.5,13.1,7.1,26.8,16.7,36.4c9.5,9.5,23,13.1,35.9,16.6c9,2.4,17.5,4.6,24.4,8.7 c6.5,3.8,12.5,9.8,18.9,16.2c9.7,9.8,19.6,19.8,33.2,23.5c3.8,1,7.6,1.5,11.8,1.5c9.6,0,19.3-2.7,28.5-5.1c8.8-2.4,17-4.6,24.5-4.6 c8,0,16.5,2.3,25.5,4.6c13,3.6,26.6,7.1,39.5,3.7c13.2-3.6,23.1-13.5,32.7-23.1c6.5-6.5,12.6-12.6,19.4-16.6 c6.7-3.9,15.1-6.1,24-8.5c13.1-3.5,26.8-7.1,36.4-16.8c9.5-9.5,13.1-23,16.6-36c2.4-9,4.6-17.5,8.7-24.4c3.8-6.5,9.8-12.5,16.2-18.9 c9.8-9.7,19.9-19.7,23.6-33.3C495.7,301.4,494.4,287.7,488.5,274.5z"></path>
                    </svg>
                </div>

                <div class="icon icon_heart"></div>
            </div>
            <h1>Profile Page</h1>
            <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

                <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

                    <div class="page-wrapper" style="display: block;">
                        <div>
                            <?php if (isset($_SESSION['use']['fullname'])) { ?>
                                <div class="align-self-center">
                                    <h3 class="page-title text-truncate text-dark font-weight-medium">Good Morning <?php echo $_SESSION['use']['fullname'] ?></h3>
                                </div>
                            <?php }
                            if (isset($_SESSION['isLogin'])) { ?>

                                <div class="align-self-center">
                                    <form method='post' action='' style="width: 25vw;margin: 2rem auto;">
                                        <?php
                                        $sql = "SELECT * FROM users WHERE user_id = {$_SESSION['use']['user_id']}";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "
                                    <div class='form-group'>
                                   <input type='text' class='form-control' id='user_name' name='user_name' value={$row['fullname']} placeholder='User Name'/><br>                                     
                                        <input type='hidden' id='user_id' name='user_id' value={$row['user_id']}>
                                        <input type='text' class='form-control' id='user_email' name='user_email' value={$row['email']}
                                        placeholder='Email'><br>
                                            
                                            
                                        <input type='password' name='user_password' id='user_password' class='form-control' id='nametext' 
                                        placeholder='Password'><br>                                 

                                    </div>
                                    <input type='submit' name='save_change_PF' value='Save' class='btn btn-success'/>
                                              ";
                                        }
                                        ?>
                                    </form>
                                </div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="page-wrapper" style="display: block;">
                        <div class="container-fluid">

                            <div class="container">
                                <!-- Admins -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Orders</h4>

                                                <div class="table-responsive">
                                                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#id</th>
                                                                <th>product Name</th>
                                                                <th>description</th>
                                                                <th>Price</th>
                                                                <th>Offer</th>
                                                                <th>Store</th>
                                                                <th>Category</th>
                                                                <!-- <th>Edit</th> -->
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php $query = "SELECT *
                                           FROM products,category,store,order_details,orders
                                           WHERE
                                           products.store_id = store.store_id AND order_details.pro_id = products.pro_id AND category.cat_id = products.cat_id ";

                                                            $result = mysqli_query($conn, $query);

                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<tr> <form action='' method='POST'> ";
                                                                echo "<td>{$row['pro_id']}</td>";

                                                                echo "<td>{$row['pro_name']}</td>";

                                                                echo "<td>{$row['pro_desc']}</td>";

                                                                echo "<td>{$row['pro_price']}</td>";

                                                                echo "<td>{$row['offer']}</td>";

                                                                echo "<td>{$row['store_name']}</td>";

                                                                echo "<td>{$row['cat_name']}</td>";


                                                                echo "<td><a href='profile_page.php?id={$row['order_id']}' class='btn btn-danger'>Delete</a></td>";

                                                                echo "</form></tr>";
                                                            }

                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
</section>
<!--End Call to Action -->

<?php include 'include/footer.php' ?>