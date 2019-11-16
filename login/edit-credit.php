<?php
session_start();
error_reporting(0);
include('D:\Xampp\htdocs\Expense-Manager\login\includes\dbh.inc.php');
if(!isset($_SESSION['userId'])){
    header('location: ../login/includes/logout.inc.php');
} else{

    if(isset($_GET['editid'])) {
        $dateexpense = $_GET['transDate'];
        $info = $_GET['transInfo'];
        $type = $_GET['transType'];
        $costitem = $_GET['transAmount'];
        $category = strval($_GET['transCategory']);
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }

if(isset($_POST['submit']))
  {
      $userid=intval($_SESSION['userId']);
      $transId = intval($_GET['editid']);
      $dateexpense=$_POST['dateexpense'];
      $info=$_POST['info'];
      $costitem=$_POST['cost'];
      $category=strval($_POST['category']);

     $postvar = json_encode($_POST);
     echo "<script>console.log($postvar);</script>";
    $query=mysqli_query($conn, "UPDATE expenses
         SET transDate = '$dateexpense',
             idUsers = '$userid',
             transInfo = '$info',
             transType = 'D',
             transAmount = '$costitem',
             transCategory = '$category'
         WHERE transId = '$transId'");
if($query){
echo "<script>alert('Transaction has been updated');</script>";
echo "<script>window.location.href='manage-expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}
  
}}
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
				<li class="active">Expense</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Expense</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Date of Expense</label>
									<input class="form-control" type="date" value="<?php echo $dateexpense;?>" name="dateexpense" required="true">
								</div>
								<div class="form-group">
									<label>Description</label>
									<input type="text" class="form-control" name="info" value="<?php echo $info;?>" >
								</div>
								
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="text" value="<?php echo $costitem;?>" required="true" name="cost">
                                </div>
                                
                                <div class="form-group">
									<label>Category</label>
                                    <select class="form-control" name="category" required>
                                    <option <?php if($category== 'income'){echo("selected");}?> value='income'>Income</option>
                                    <option <?php if($category== 'award'){echo("selected");}?> value='award'>Awards</option>
                                    <option <?php if($category== 'gift'){echo("selected");}?> value='gift'>Gifts</option>
                                    <option <?php if($category== 'other'){echo("selected");}?> value='other'>Other</option>
                                    </select>
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Update</button>
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
