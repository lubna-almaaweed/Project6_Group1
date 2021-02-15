<?php
require('includes/connection.php');

$email    = "";
$password = "";
$fullname = "";
$update   = false;

if (isset($_GET['action']) && $_GET['action'] == 'edit') {

	// fetch old data 
	$query  = "select * from users where user_id = {$_GET['id']}";
	$result = mysqli_query($conn, $query);
	$row    = mysqli_fetch_assoc($result);

	$email    = $row['email'];
	$password = $row['password'];
	$fullname = $row['fullname'];
	$update   = true;

	if (isset($_POST['update'])) {

		// fetch data from form 
		$email    = $_POST['email'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];

		$query = "UPDATE users SET email     = '$email',
									password = '$password',
									fullname = '$fullname',
	                             WHERE user_id = {$_GET['id']}";
		mysqli_query($conn, $query);
		$update = false;
		header("location:manage_users.php");
	}
}

if (isset($_POST['submit'])) {
	// fetch data from form 
	$email    = $_POST['email'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];

	$query = "INSERT INTO users(email ,password,fullname)
	         values('$email','$password','$fullname')";
	mysqli_query($conn, $query);

	$email    = '';
	$password = '';
	$fullname = '';
}


include('includes/admin_header.php');  ?>
<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">Manage user</div>
						<div class="card-body">
							<div class="card-title">
								<h3 class="text-center title-2">Create user</h3>
							</div>
							<hr>
							<form action="" method="post">
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">user Email</label>
									<input name="email" type="text" class="form-control" value="<?php echo $email; ?>">
								</div>
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">user Password</label>
									<input name="password" type="password" class="form-control" value="<?php echo $password; ?>">
								</div>
								<div class="form-group">
									<label for="cc-payment" class="control-label mb-1">user Fullname</label>
									<input name="fullname" type="text" class="form-control" value="<?php echo $fullname; ?>">
								</div>
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
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query  = "select * from users";
								$result = mysqli_query($conn, $query);
								while ($result  && $row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>{$row['user_id']}</td>";
									echo "<td>{$row['email']}</td>";
									echo "<td>{$row['fullname']}</td>";
									echo "<td><a href='manage_users.php?id={$row['user_id']}&action=edit'' class='btn btn-warning'>Edit</a></td>";
									echo "<td><a href='delete_admin.php?id={$row['user_id']}&type=user' class='btn btn-danger'>Delete</a></td>";
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