<?php
require('includes/connection.php');

$name        = "";
$description = "";
$image       = "";
$cat_id      = "";
$update = false;

if (isset($_GET['action']) && $_GET['action'] == 'edit') {

    // fetch old data 
    $query  = "select * from store where store_id  = {$_GET['id']}";
    $result = mysqli_query($conn, $query);
    $row    = mysqli_fetch_assoc($result);
    $name        = $row['store_name'];
    $description = $row['store_bio'];
    $image       = $row['store_img'];

    $update = true;

    $query = "select cat_id  from store where store_id = {$_GET['id']}";
    $selected_category = mysqli_query($conn, $query);
    $fetched_data = mysqli_fetch_all($selected_category);

    if (isset($_POST['update'])) {

        // fetch data from form 
        $name        = $_POST['name'];
        $description = $_POST['description'];
        $cat_id      = $_POST['cat_id'];


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
            $filename =  $row['store_img'];
        };

        $query = "UPDATE store SET store_name  = '$name',
                                    store_bio  = '$description',
                                    store_img  = '$filename',
                                    cat_id     = '$cat_id[0]'
	                           WHERE store_id  = {$_GET['id']}";
        mysqli_query($conn, $query);

        $update = false;
        header("location:Manage_Stors.php");
    }
}

if (isset($_POST['submit'])) {
    // fetch data from form 
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $cat_id      = $_POST['cat_id'];
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/" . $filename;


    $query = "INSERT INTO store(store_name  ,store_bio  ,store_img, cat_id )
	         values('$name','$description','$filename', '$cat_id[0]')";
    mysqli_query($conn, $query);
    $name        = "";
    $description = "";
    $filename    = "";
    $cat_id      = "";

    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'hot') {

    $deleteQuert = "DELETE FROM hot_pro WHERE h_store_id = {$_GET['id']}";
    $pro_id = $_GET['pro'];
    $query = "INSERT INTO hot_pro(h_pro_id  ,h_store_id)
    values('{$_GET['pro']}','{$_GET['id']}')";
    mysqli_query($conn, $deleteQuert);
    mysqli_query($conn, $query);
    header("location:Manage_Stors.php");
}


include('includes/admin_header.php');  ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Manage store</div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create store</h3>
                            </div>
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">store name</label>
                                    <input name="name" type="text" class="form-control" value="<?php echo $name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">store description</label>
                                    <input name="description" type="text" class="form-control" value="<?php echo $description; ?>">
                                </div>

                                <div class="row form-group ">
                                    <div class="col col-md-3">
                                        <label for="cat_id" class=" form-control-label">Select category</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <select name="cat_id[]" class="form-control col-lg-6">
                                            <?php
                                            $query  = "select * from category";
                                            $result = mysqli_query($conn, $query);

                                            if ($update != true) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['cat_id']}'>{$row['cat_name']}</option>";
                                                }
                                            } else {
                                                // to fetch the selected categories
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
                                    <label for="cc-payment" class="control-label mb-1">store image</label>
                                    <input name="image" type="file" accept="image/*" class="form-control">
                                    <?php
                                    if ($update == true) {
                                        echo  " <p>current image : </p> <img  height='100px' width='100px' src='images/{$image}' alt='test'>";
                                    } ?>



                                </div>



                                <div>
                                    <?php
                                    if ($update == true) :
                                    ?>
                                        <button class="btn btn-info" type="submit" name="update"> Update</button>
                                    <?php else : ?>
                                        <button type="submit" class="btn btn-primary" name="submit">Save </button>
                                    <?php endif; ?>

                                </div>
                            </form>
                            <!-- <form action="Manage_Stors.php?id={$row['store_id']}&action=hot" method="post" enctype="multipart/form-data">

                                <div class="row form-group ">
                                    <div class="col">
                                        <select name="hot_pro[]" class="form-control">
                                            <?php
                                            foreach ($row2 as $k => $value) {

                                                foreach ($fetched_hot as $key => $value2) {
                                                    if ($row2[$k][0] == $value2[0]) {
                                                        echo "<option selected value='{$value[0]}'>{$value[1]}</option>";
                                                        unset($row2[$k]);
                                                        continue 2;
                                                    }
                                                }
                                                echo "<option  value='{$value[0]}'>{$value[1]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary" name="submit">Save </button>
                                </div>
                            </form> -->
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
                                    <th>bio</th>
                                    <th>Category</th>
                                    <th>choose hot product</th>
                                    <th>iamge</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query  = "select * from store";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['store_id']}</td>";
                                    echo "<td>{$row['store_name']}</td>";
                                    echo "<td>{$row['store_bio']}</td>";
                                    echo "<td>";
                                    $cat_name_query  = "select * from category where cat_id = {$row['cat_id']} ";
                                    $cat_name_result = mysqli_query($conn, $cat_name_query);
                                    $cat_name_row = mysqli_fetch_assoc($cat_name_result);
                                    echo "{$cat_name_row['cat_name']}</td>";
                                ?>
                                    <td>
                                        <?php
                                        $query2  = "select pro_name, pro_id from products where store_id = {$row['store_id']} ";
                                        $result2 = mysqli_query($conn, $query2);
                                        $row2 = mysqli_fetch_all($result2);

                                        $hot_query = "select * from hot_pro where h_store_id ={$row['store_id']}";
                                        $selected_category = mysqli_query($conn, $hot_query);
                                        $fetched_hot = mysqli_fetch_all($selected_category);

                                        // echo "<pre> ";
                                        // print_r($fetched_hot);
                                        // print_r($row2);
                                        // echo "</pre> {$row['store_id']}";
                                        ?>
                                        <select name="hot_pro[]" id="hotPro<?php echo $row['store_id']; ?>" class="form-control">
                                            <?php
                                            foreach ($row2 as $k => $value) {
                                                if (isset($fetched_hot)) {
                                                    foreach ($fetched_hot as $key => $value2) {

                                                        if ($row2[$k][1] == $value2[1]) {
                                                            echo "<option selected value='{$value[1]}'>{$value[0]}</option>";
                                                            unset($row2[$k]);
                                                            continue 2;
                                                        }
                                                    }
                                                }
                                                echo "<option  value='{$value[1]}'>{$value[0]}</option>";
                                            }


                                            ?>
                                        </select>
                                        <script>
                                            let urlmenu<?php echo $row['store_id']; ?> = document.getElementById("hotPro<?php echo $row['store_id']; ?>");
                                            urlmenu<?php echo $row['store_id']; ?>.onchange = function() {
                                                window.open('Manage_Stors.php?id=<?php echo $row['store_id']; ?>&action=hot&pro=' + this.options[this.selectedIndex].value);
                                                window.close();

                                            };
                                        </script>
                                    </td>

                                <?php
                                    echo "<td><img  height='100px' width='100px' src='images/{$row['store_img']}' alt='test'></td>";

                                    echo "<td><a href='Manage_Stors.php?id={$row['store_id']}&action=edit' class='btn btn-warning'>Edit</a></td>";
                                    echo "<td><a href='delete_admin.php?id={$row['store_id']}&type=store' class='btn btn-danger'>Delete</a></td>";
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