<?php
error_reporting(0);
require'dbh.inc.php' ;
?>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
           <!--  <div class="profile-userpic">
                <img src="http://placehold.it/50/4CAF50/fff" class="img-responsive" alt="">
            </div> -->
            <div class="profile-usertitle">
                
                <div class="profile-usertitle-name"><?php echo $_SESSION['userUid'];?></div>
               <!--  <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div> -->
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        
        <ul class="nav menu">
            <li class="active"><a href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            
            
           
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em>Expenses <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="add-expense.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Expenses
                    </a></li>
                    <li><a class="" href="add-credit.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Credit
                    </a></li>
                    <li><a class="" href="manage-expense.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Manage Expenses
                    </a></li>
                    
                </ul>

            </li>
           




            
            <li><a href="profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
             <li><a href="change-password.php"><em class="fa fa-clone">&nbsp;</em> Change Password</a></li>
<li><a href="includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>