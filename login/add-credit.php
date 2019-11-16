<?php
session_start();
error_reporting(0);
include('D:\Xampp\htdocs\Expense-Manager\login\includes\dbh.inc.php');
if(!isset($_SESSION['userId'])){
    header('location: ../login/includes/logout.inc.php');
} else{

if(isset($_POST['submit']))
  {
  	$userid=$_SESSION['userId'];
    $datecredit=$_POST['datecredit'];
     $info=$_POST['info'];
     $costitem=$_POST['cost'];
     $category=$_POST['category'];
    $query=mysqli_query($conn, "insert into expenses(idUsers,transDate,transType,transAmount,transCategory,transInfo) value('$userid','$datecredit','C','$costitem','$category','$info')");
if($query){
echo "<script>alert('Credit has been added');</script>";
// echo "<script>window.location.href='manage-expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}
  
}
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Add Expense</title>
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
				<li class="active">Credit</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Credit</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Date of Credit</label>
									<input class="form-control" type="date" value="" name="datecredit" required="true">
								</div>
								<div class="form-group">
									<label>Credit</label>
									<input type="text" class="form-control" name="info" value="" >
								</div>
								
								<div class="form-group">
									<label>Credit amount</label>
									<input class="form-control" type="text" value="" required="true" name="cost">
                                </div>
                                <div class="form-group">
									<label>Category</label>
                                    <select class="form-control" name="category" required>
                                        <option value="income">Income</option>
                                        <option value="award">Award</option>
                                        <option value="gift">Gifts</option>
                                        <option value="other">Other</option>
                                    </select>
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Add</button>
								</div>
								
								
								</div>
								
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