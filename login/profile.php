<?php
session_start();
error_reporting(0);
include('D:\Xampp\htdocs\Expense-Manager\login\includes\dbh.inc.php');
if(!isset($_SESSION['userId']))
{
    header('location: ../login/includes/logout.inc.php');
}
else{
    if(isset($_POST['submit']))
  {
    $userid=$_SESSION['userId'];
    $email=$_POST['userEmail'];
    $budget=$_POST['userBudget'];
    $sql="SELECT * FROM users WHERE emailUsers=? AND idUsers!='$userid'";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        $msg="Sql Error!";
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck=mysqli_stmt_num_rows($stmt);
        if($resultCheck>0){
            $msg="Email is already taken!";

    }
    else{
        $query=mysqli_query($conn, "update users set emailUsers ='$email', budget='$budget' where idUsers='$userid'");
        if ($query) {
        $msg="User profile has been updated.";
      }
      else
        {
          $msg="Something Went Wrong. Please try again.";
        }
      }

    }
    
        }

   
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || User Profile</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Profile</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Profile</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							 <?php
$userid=$_SESSION['userId'];
$ret=mysqli_query($conn,"select * from users where idUsers='$userid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
							<form role="form" method="post" action="">
                            <div class="form-group">
									<label>Username</label>
<input type="text" class="form-control" name="userName" value="<?php  echo $row['uidUsers'];?>" required="true" readonly="true">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" type="email" value="<?php  echo $row['emailUsers'];?>" name="userEmail" required="true">
								</div>
								
								<div class="form-group">
									<label>Budget</label>
									<input class="form-control" name="userBudget" type="number" value="<?php  echo $row['budget'];?>">
								</div>
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Update</button>
								</div>
								
								
								</div>
								<?php } ?>
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
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