<?php
require('includes/connection.php');

$pro_name  = "";
$pro_desc  = "";
$pro_price = "";
$pro_offer = "";
$store_id  = "";
$update    = false;
$is_off     = "false";

if (isset($_GET['action']) && $_GET['action'] == 'edit') {

    // fetch old data 
    $query  = "select * from products where pro_id = {$_GET['id']}";
    $result = mysqli_query($conn, $query);
    $row    = mysqli_fetch_assoc($result);

    $image_source = $row['pro_img'];
    $pro_name     = $row['pro_name'];
    $pro_desc     = $row['pro_desc'];
    $pro_price    = $row['pro_price'];
    if (isset($row['offer'])) {
        $pro_offer = $row['offer'];
    };
    $update = true;

    $query = "select store_id  from products where pro_id = {$_GET['id']}";
    $selected_category = mysqli_query($conn, $query);
    $fetched_data = mysqli_fetch_all($selected_category);

    if (isset($_POST['update'])) {

        // fetch data from form 
        $pro_name  = $_POST['name'];
        $pro_desc  = $_POST['description'];
        $pro_price = $_POST['price'];
        $pro_offer = $_POST['pro_offer'];
        $store_id  = $_POST['store_id'];
        // echo "<pre style='font-size: 18rem; width: 18rem; height: 18rem; background-color : #114128 '> hiiiiii ";
        // print_r($_POST);
        // echo "</pre>";

        if ($_POST['pro_offer'] > 0) {
            $is_off   = "true";
        } else {
            $is_off   = "false";
        }

        if ($_FILES["image"]["name"]) {
            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "images/" . $filename;

            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }
        } else {
            $filename =  $image_source;
        };

        $query = "UPDATE products SET pro_name  = '$pro_name',
	                                  pro_desc  = '$pro_desc',
	                                  pro_price = '$pro_price',
	                                  offer     = '$pro_offer',
	                                  is_off    = '$is_off',
	                                  store_id  = '$store_id[0]',
	                                  pro_img   = '$filename'
	                            WHERE pro_id    = {$_GET['id']}";
        mysqli_query($conn, $query);

        $update = false;
        header("location:Manage_products.php");
    }
}

if (isset($_POST['submit'])) {

    // fetch data from form 
    $pro_name   = $_POST['name'];
    $pro_desc   = $_POST['description'];
    $pro_price  = $_POST['price'];
    $pro_offer  = $_POST['pro_offer'];
    $store_id  = $_POST['store_id'];

    if ($pro_offer > 0) {
        echo "<h1> Hi--- {$_POST['pro_offer']} </h1>";
        $is_off   = "true";
    }


    // fetch and upload image
    $filename   = $_FILES["image"]["name"];
    $tempname   = $_FILES["image"]["tmp_name"];
    $folder     = "images/" . $filename;
    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }

    // add product
    $query = "INSERT INTO products(pro_name ,pro_desc ,pro_price, offer, is_off  , pro_img ,store_id)
	         values('$pro_name','$pro_desc','$pro_price', '$pro_offer', '$is_off' , '$filename', '$store_id[0]')";
    mysqli_query($conn, $query);
    $pro_name   = '';
    $pro_desc   = '';
    $pro_price  = '';
    $pro_offer  = '';
    $store_id  = '';
    $is_off     = false;
}

include('includes/admin_header.php');  ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Manage products</div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create product</h3>
                            </div>
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">product name</label>
                                    <input name="name" type="text" class="form-control" value="<?php echo $pro_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">product description</label>
                                    <input name="description" type="text" class="form-control" value="<?php echo $pro_desc; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="price" class="control-label mb-1">product price</label>
                                    <input name="price" type="number" class="form-control" value="<?php echo $pro_price; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="pro_offer" class="control-label mb-1">product offer price</label>
                                    <input name="pro_offer" type="number" class="form-control" value="<?php echo $pro_offer; ?>">
                                </div>

                                <div class="row form-group ">
                                    <div class="col col-md-3">
                                        <label for="store_id" class=" form-control-label">Select store</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <select name="store_id[]" class="form-control col-lg-6">
                                            <?php
                                            $query  = "select * from store";
                                            $result = mysqli_query($conn, $query);

                                            if ($update != true) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['store_id']}'>{$row['store_name']}</option>";
                                                }
                                            } else {
                                                // to fetch the selected stores
                                                $row = mysqli_fetch_all($result);
                                                foreach ($row as $k => $value) {

                                                    foreach ($fetched_data as $key => $value2) {
                                                        if ($row[$k][0] == $value2[0]) {
                                                            echo "<option selected value='{$value[0]}'>{$value[1]}</option>";
                                                            unset($row[$k]);
                                                            continue 2;
                                                        }
                                                    }
                                                    echo "<option  value='{$value[0]}'>{$value[1]}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">product image</label>
                                    <input name="image" type="file" accept="image/*" class="form-control">
                                    <?php
                                    if ($update == true) {
                                        echo  " <p>current image : </p> <img  height='100px' width='100px' src='images/{$image_source}' alt='test'>";
                                    } ?>

                                </div>

                                <div class="center">
                                    <?php
                                    if ($update == true) :
                                    ?>
                                        <button class="btn btn-info" type="submit" name="update"> Update</button>
                                    <?php else : ?>
                                        <button type="submit" class="btn btn-primary col-lg-3" name="submit">Save </button>
                                    <?php endif; ?>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>description</th>
                                    <th>price</th>
                                    <th>offer</th>
                                    <th>store</th>
                                    <th>iamge</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query  = "select * from products";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['pro_id']}</td>";
                                    echo "<td>{$row['pro_name']}</td>";
                                    echo "<td>{$row['pro_desc']}</td>";
                                    echo "<td>{$row['pro_price']}</td>";
                                    echo "<td>{$row['offer']}</td>";

                                    echo "<td>";
                                    $cat_query  = "select * from store where store_id = {$row['store_id']} ";

                                    $cat_result = mysqli_query($conn, $cat_query);
                                    $cat_row = mysqli_fetch_assoc($cat_result);
                                    $cat_name_query  = "select store_name from store where store_id = {$cat_row['store_id']} ";
                                    $cat_name_result = mysqli_query($conn, $cat_name_query);
                                    $cat_name_row = mysqli_fetch_assoc($cat_name_result);
                                    echo "{$cat_name_row['store_name']}</td>";

                                    echo "<td><img height='100px' width='100px' src='images/{$row['pro_img']}' alt='test'></td>";
                                    echo "<td><a href='Manage_products.php?id={$row['pro_id']}&action=edit' class='btn btn-warning'>Edit</a></td>";
                                    echo "<td><a href='delete_admin.php?id={$row['pro_id']}&type=pro' class='btn btn-danger'>Delete</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/admin_footer.php');  ?>