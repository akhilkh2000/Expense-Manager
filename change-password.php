<?php
session_start();
error_reporting(0);
include('.\includes\dbh.inc.php');
if (!isset($_SESSION['userId'])) {
	header('location: ../login/includes/logout.inc.php');
} else {

	if (isset($_POST['submit'])) {
		$userid = $_SESSION['userUid'];
		$cpassword = ($_POST['currentpassword']);
		$newpassword = ($_POST['newpassword']);




		$sql = "SELECT * FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../dashboard.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $userid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$pwdCheck = password_verify($cpassword, $row['pwdUsers']);
				if ($pwdCheck == false) {
					$msg = "Your current password is wrong.";
					#header("Location: ../dashboard.php?error=wrongpwd");
					// exit();
				} else if ($pwdCheck == true) {
					$sql = "UPDATE users SET pwdUsers=? WHERE uidUsers=?";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: .\change-password.php?error=sqlerror");
						exit();
					} else {
						$hashed = password_hash(strval($newpassword), PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "ss", $hashed, $userid);
						mysqli_stmt_execute($stmt);
						$msg = 'SUCCESS';
						// header("Location: ../signup.php?error=success");
						// exit();

					}

					// header("Location: D:\Xampp\htdocs\Expense-Manager\login\change-password.php");
					// $hashed = password_hash($newpasssword, PASSWORD_DEFAULT);
					// $ret=mysqli_query($conn,"update users set pwdUsers='$hashed' where uidUsers='$userid'");
					// $msg= "Your password successully changed"; 
				}
			}
		}
	}








	// $query=mysqli_query($conn,"select * from users where uidUsers='$userid'");
	// $row=mysqli_fetch_array($query);
	// if($row){

	//     $pwdCheck=password_verify($cpassword, $row['pwdUsers']);
	//     if($pwdCheck==true)
	//         {
	//             $m="HIII";
	//             $ret=mysqli_query($conn,"update users set pwdUsers='$newpassword' where uidUsers='$userid'");
	//              $msg= "Your password successully changed"; 

	//         }
	//         else {
	//             $msg="Your current password is wrong.";
	//             }

	//}

	// $ret=mysqli_query($conn,"update users set pwdUsers='$newpassword' where uidUsers='$userid'");
	// $msg= "Your password successully changed"; 


	//}


?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Daily Expense Tracker || Change Password</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/datepicker3.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">

		<!--Custom Font-->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		<script type="text/javascript">
			function checkpass() {
				if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
					alert('New Password and Confirm Password field does not match');
					document.changepassword.confirmpassword.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>

	<body>
		<?php include_once('includes/header.php'); ?>
		<?php include_once('includes/sidebar.php'); ?>

		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#">
							<em class="fa fa-home"></em>
						</a></li>
					<li class="active">Change Password</li>
				</ol>
			</div>
			<!--/.row-->




			<div class="row">
				<div class="col-lg-12">



					<div class="panel panel-default">
						<div class="panel-heading">Change Password</div>
						<div class="panel-body">
							<p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
																						echo $msg;
																					}  ?> </p>
							<div class="col-md-12">
								<?php
								$userid = $_SESSION['userId'];
								$ret = mysqli_query($conn, "select * from users where idUsers='$userid'");
								$cnt = 1;
								while ($row = mysqli_fetch_array($ret)) {

								?>
									<form role="form" method="post" action="" name="changepassword" onsubmit="return checkpass();">
										<div class="form-group">
											<label>Current Password</label>
											<input type="password" name="currentpassword" class=" form-control" required="true" value="">
										</div>
										<div class="form-group">
											<label>New Password</label>
											<input type="password" name="newpassword" class="form-control" value="" required="true">
										</div>

										<div class="form-group">
											<label>Confirm Password</label>
											<input type="password" name="confirmpassword" class="form-control" value="" required="true">
										</div>

										<div class="form-group has-success">
											<button type="submit" class="btn btn-primary" name="submit">Change</button>
										</div>


							</div>
						<?php } ?>
						</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php'); ?>
		</div><!-- /.row -->
		</div>
		<!--/.main-->

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/chart.min.js"></script>
		<script src="js/chart-data.js"></script>
		<script src="js/easypiechart.js"></script>
		<script src="js/easypiechart-data.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/custom.js"></script>

	</body>

	</html>
<?php }  ?>