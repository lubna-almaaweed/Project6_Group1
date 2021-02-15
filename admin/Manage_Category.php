<?php
require('includes/connection.php');

$name        = "";
$description = "";
$image       = "";
$update = false;

if (isset($_GET['action']) && $_GET['action'] == 'edit') {

    // fetch old data 
    $query  = "select * from category where cat_id = {$_GET['id']}";
    $result = mysqli_query($conn, $query);
    $row    = mysqli_fetch_assoc($result);
    $name        = $row['cat_name'];
    $description = $row['cat_desc'];
    $image       = $row['cat_img'];
    $update = true;
    // print_r($row);


    if (isset($_POST['update'])) {

        // fetch data from form 
        $name        = $_POST['name'];
        $description = $_POST['description'];

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
            $filename =  $row['cat_img'];
        };

        $query = "UPDATE category SET cat_name = '$name',
	                           cat_desc = '$description',
	                           cat_img = '$filename'
	                           WHERE cat_id = {$_GET['id']}";
        mysqli_query($conn, $query);

        $update = false;
        header("location:Manage_category.php");
    }
}

if (isset($_POST['submit'])) {
    // fetch data from form 
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/" . $filename;


    $query = "INSERT INTO category(cat_name ,cat_desc ,cat_img)
	         values('$name','$description','$filename')";
    mysqli_query($conn, $query);
    $name        = "";
    $description = "";
    $filename    = "";

    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
}


include('includes/admin_header.php');  ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Manage category</div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create category</h3>
                            </div>
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">category name</label>
                                    <input name="name" type="text" class="form-control" value="<?php echo $name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">category description</label>
                                    <input name="description" type="text" class="form-control" value="<?php echo $description; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">category image</label>
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
                                    <th>iamge</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query  = "select * from category";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['cat_id']}</td>";
                                    echo "<td>{$row['cat_name']}</td>";
                                    echo "<td>{$row['cat_desc']}</td>";
                                    echo "<td><img  height='100px' width='100px' src='images/{$row['cat_img']}' alt='test'></td>";
                                    echo "<td><a href='Manage_category.php?id={$row['cat_id']}&action=edit' class='btn btn-warning'>Edit</a></td>";
                                    echo "<td><a href='delete_admin.php?id={$row['cat_id']}&type=cat' class='btn btn-danger'>Delete</a></td>";
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