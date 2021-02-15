<?php
require('includes/connection.php');

$email    = "";
$password = "";
$fullname = "";
$update   = false;

if (isset($_GET['action']) && $_GET['action'] == 'edit') {

	// fetch old data 
	$query  = "select * from admin where admin_id = {$_GET['id']}";
	$result = mysqli_query($conn, $query);
	$row    = mysqli_fetch_assoc($result);

	$email    = $row['admin_email'];
	$password = $row['admin_pass'];
	$fullname = $row['admin_name'];
	$store_id = $row['store_id'];
	$update   = true;

	$query = "select store_id  from admin where admin_id = {$_GET['id']}";
	$selected_store = mysqli_query($conn, $query);
	$fetched_data = mysqli_fetch_all($selected_store);



	if (isset($_POST['update'])) {

		// fetch data from form 
		$email    = $_POST['email'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		$store_id = $_POST['store_id'];

		$query = "UPDATE admin SET admin_email  = '$email',
									admin_pass  = '$password',
									admin_name  = '$fullname',
									store_id    = '$store_id'
	                             WHERE admin_id = {$_GET['id']}";
		mysqli_query($conn, $query);
		$update = false;
		header("location:manage_admin.php");
	}
}

if (isset($_POST['submit'])) {
	// fetch data from form 
	$email    = $_POST['email'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];
	$store_id = $_POST['store_id'];


	$query = "INSERT INTO admin(admin_email ,admin_pass,admin_name,store_id)
	         values('$email','$password','$fullname','$store_id')";
	mysqli_query($conn, $query);

	$email    = '';
	$password = '';
	$fullname = '';
}


include('includes/admin_header.php');  ?>
<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid ">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">Manage Admin</div>
						<div class="card-body">
							<div class="card-title">
								<h3 class="text-center title-2">Create Admin</h3>
							</div>
							<hr>
							<form action="" method="post">
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Admin Email</label>
									<input name="email" type="text" class="form-control" value="<?php echo $email; ?>">
								</div>
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Admin Password</label>
									<input name="password" type="password" class="form-control" value="<?php echo $password; ?>">
								</div>
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">Admin Fullname</label>
									<input name="fullname" type="text" class="form-control" value="<?php echo $fullname; ?>">
								</div>
								<label for="store_id" class="control-label mb-1">Admin store</label>
								<select name="store_id" class="form-control col-lg-6 m-b-3">
									<?php
									$query  = "select * from store";
									$result = mysqli_query($conn, $query);

									if ($update != true) {
										while ($row = mysqli_fetch_assoc($result)) {
											echo "<option value={$row['store_id']}>{$row['store_name']}</option>";
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


								<div>
									<?php
									if ($update == true) :
									?>
										<button class="btn btn-info" type="submit" name="update"> Update</button>
									<?php else : ?>
										<button type="submit" class="btn btn-primary" name="submit">Save </button>
									<?php endif; ?>

									</button>
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
									<th>Email</th>
									<th>Fullname</th>
									<th>store</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query  = "select * from admin";
								$result = mysqli_query($conn, $query);
								while ($result  && $row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>{$row['admin_id']}</td>";
									echo "<td>{$row['admin_email']}</td>";
									echo "<td>{$row['admin_name']}</td>";
									echo "<td>";
									$cat_name_query  = "select * from store where store_id = {$row['store_id']} ";
									$cat_name_result = mysqli_query($conn, $cat_name_query);
									$cat_name_row = mysqli_fetch_assoc($cat_name_result);
									echo "{$cat_name_row['store_name']}</td>";
									echo "<td><a href='manage_admin.php?id={$row['admin_id']}&action=edit'' class='btn btn-warning'>Edit</a></td>";
									echo "<td><a href='delete_admin.php?id={$row['admin_id']}&type=admin' class='btn btn-danger'>Delete</a></td>";
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