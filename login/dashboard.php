<?php
session_start();

 if(!isset($_SESSION['userId'])){
     header('location: ../login/includes/logout.inc.php');
 }
 else{
     require'D:\Xampp\htdocs\Expense-Manager\login\includes\sidebar.php';
     $userid = intval($_SESSION['userId']);
     $userData=mysqli_query($conn,"select budget, startBalance from users where idUsers='$userid'");
     $row=mysqli_fetch_assoc($userData);
     $userBalance = $row['startBalance'];
     $userBudget = $row['budget'];

     $expenseData=mysqli_query($conn,"select * from expenses where idUsers='$userid'");
     $userExpenses = 0;
     while($row=mysqli_fetch_assoc($expenseData)) {
        if ($row['transType'] == 'D')
            $userExpenses += intval($row['transAmount']);
        else
            $userExpenses -= intval($row['transAmount']);
     }

     $currentMonth = date('m');
     $currentYear = date('Y');

     $firstDayOfMonthDate = $currentYear . "-" . $currentMonth . "-" . "01";
     $currentMonthExpenses = mysqli_query($conn,"SELECT * FROM expenses WHERE transDate >= '" . $firstDayOfMonthDate . "' AND idUsers='$userid'");

    $currentExpense = 0;
    while($row=mysqli_fetch_assoc($currentMonthExpenses)) {
        if ($row['transType'] == 'D')
            $currentExpense += intval($row['transAmount']);
        else
            $currentExpense -= intval($row['transAmount']);
     }

     $past7daysDate = date('Y-m-d', strtotime("-7 day", strtotime(date('Y-m-d'))));
     $past7daysExpenses = mysqli_query($conn,"SELECT * FROM expenses WHERE transDate >= '" . $past7daysDate . "' AND idUsers='$userid'");

     $past30daysDate = date('Y-m-d', strtotime("-30 day", strtotime(date('Y-m-d'))));
     $past30daysExpenses = mysqli_query($conn,"SELECT * FROM expenses WHERE transDate >= '" . $past30daysDate . "' AND idUsers='$userid'");

 }  
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-12">					
				<div class="panel panel-default">
					<div class="panel-heading">Account Report</div>
					<div class="panel-body">
                        Starting Balance: <?php echo $userBalance; ?> <br>
                        Current Balance: <?php echo $userBalance - $userExpenses; ?> <br>
                        Budget: <?php echo $userBudget; ?> <br>
                        Current Month Expenses: <?php echo $currentExpense; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
			<div class="col-lg-12">	
				
				<div class="panel panel-default">
					<div class="panel-heading">Expense Report</div>
					<div class="panel-body">
						<div class="col-md-12">
                            <form role="form" method="post" action="">

                                <div class="form-group">
                                    <label>Time Period</label>
                                    <select class="form-control" name="period" required>
                                        <option value="week" selected>Past 7 days</option>
                                        <option value="month">Past 30 Days</option>
                                    </select>
                                </div>
                                                                
                                <div class="form-group has-success">
                                    <button type="submit" class="btn btn-primary" name="submit">Show Report</button>
                                </div>

                            </form>
                        </div>
                        

                        <div>
                        <table class="table table-bordered mg-b-0">
                            <thead>
                                <tr>
                                <th>Transaction ID</th>
                                <th>Transaction Info</th>
                                <th>Credit/Debit</th>
                                <th>Transaction Category</th>
                                <th>Amount</th>
                                <th>Expense Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $expenseTable = $past7daysExpenses;
                                if(isset($_POST['submit']))
                                {
                                    $period=strval($_POST['period']);
                                    
                                    if($period == 'week') {
                                        $expenseTable = $past7daysExpenses;
                                    }
                                    else {
                                        $expenseTable = $past30daysExpenses;
                                    }
                                }
                            while ($row=mysqli_fetch_array($expenseTable)) { ?>
                                <tr>
                                <td><?php echo $row['transId'];?></td>
                            
                                <td><?php  echo $row['transInfo'];?></td>
                                <td><?php  echo $row['transType'];?></td>
                                <td><?php  echo $row['transCategory'];?></td>
                                <td><?php  echo $row['transAmount'];?></td>
                                <td><?php  echo $row['transDate'];?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                            </table>

                        </div>

					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
        </div><!-- /.row -->
        
        <div class = "row">
            <div class="col-lg-12">					
				<div class="panel panel-default">
                    <div id="debitChart" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>

        <div class = "row">
            <div class="col-lg-12">					
				<div class="panel panel-default">
                    <div id="creditChart" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div><!-- /.main -->
   
    <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    
    <script>
        window.onload = function () {
        <?php
            $dateBefore = $past7daysDate;
            if(isset($_POST['submit']))
            {
                $period=strval($_POST['period']);
                
                if($period == 'week') {
                    $dateBefore = $past7daysDate;
                }
                else {
                    $dateBefore = $past30daysDate;
                }
            }
        ?>
        <?php $debitQuery=mysqli_query($conn,"SELECT * FROM `expenses` WHERE transType = 'D' AND transDate >= '" . $dateBefore . "' AND idUsers='$userid'");?>
        <?php
            $entertainmentAmount = 0;
            $educationAmount = 0;
            $billsAmount = 0;
            $foodAmount = 0;
            $healthAmount = 0;

            while($row=mysqli_fetch_array($debitQuery)) {
                switch ($row['transCategory']) {
                    case 'entertainment':
                        $entertainmentAmount += $row['transAmount'];
                        break;
                    case 'education':
                        $educationAmount += $row['transAmount'];
                        break;
                    case 'bills':
                        $billsAmount += $row['transAmount'];
                        break;
                    case 'food':
                        $foodAmount += $row['transAmount'];
                        break;
                    case 'health':
                        $healthAmount += $row['transAmount'];            
                }
        }?>
        var debitChart = new CanvasJS.Chart("debitChart", {
            animationEnabled: true,
            title:{
                text: "Debit ",
                horizontalAlign: "left"
            },
            data: [{
                type: "doughnut",
                startAngle: 60,
                //innerRadius: 60,
                indexLabelFontSize: 17,
                indexLabel: "{label} - #percent%",
                toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                dataPoints: [
                    { y: <?php echo $entertainmentAmount?>, label: "Entertainment" },
                    { y: <?php echo $educationAmount?>, label: "Education" },
                    { y: <?php echo $billsAmount?>, label: "Bills and Utilities" },
                    { y: <?php echo $foodAmount?>, label: "Food and Beverage"},
                    { y: <?php echo $healthAmount?>, label: "Health and fitness"},
                ]
            }]
        });

        <?php $creditQuery=mysqli_query($conn,"SELECT * FROM `expenses` WHERE transType = 'C' AND transDate >= '" . $dateBefore . "' AND idUsers='$userid'");?>
        <?php
            $incomeAmount = 0;
            $giftAmount = 0;
            $awardAmount = 0;
            $otherAmount = 0;

            while($row=mysqli_fetch_array($creditQuery)) {
                switch ($row['transCategory']) {
                    case 'income':
                        $incomeAmount += $row['transAmount'];
                        break;
                    case 'award':
                        $awardAmount += $row['transAmount'];
                        break;
                    case 'gift':
                        $giftAmount += $row['transAmount'];
                        break;
                    case 'other':
                        $otherAmount += $row['transAmount'];
                
                }
        }?>
        var creditChart = new CanvasJS.Chart("creditChart", {
            animationEnabled: true,
            title:{
                text: "Credit ",
                horizontalAlign: "left"
            },
            data: [{
                type: "doughnut",
                startAngle: 60,
                //innerRadius: 60,
                indexLabelFontSize: 17,
                indexLabel: "{label} - #percent%",
                toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                dataPoints: [
                    { y: <?php echo $incomeAmount ?>, label: "Income" },
                    { y: <?php echo $awardAmount?>, label: "Award" },
                    { y: <?php echo $giftAmount?>, label: "Gifts" },
                    { y: <?php echo $otherAmount?>, label: "Other"}
                ]
            }]
        });
        
        creditChart.render();
        debitChart.render();

        }
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>