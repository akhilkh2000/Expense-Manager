<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" type="text/css" href="header.css">
</head>
<body>
<header>
    <a href="index.php" class="brand">
      <img src="wallet.png" alt="logo">
      <div class="pig">
      </div>
    </a>
  </header>

           

                <div class="login-page">
                <div class="form">
                  
                  <form class="login-form" action="includes/login.inc.php" method="post">
                  <?php
                    if(isset($_GET['error'])){
                        if($_GET['error']=="emptyfields"){
                            echo'<p style="color:red;"> Fill in all fields!</p><br>';
                        }
                        else if($_GET['error']=="sqlerror"){
                            echo'<p style="color:red;">SQL ERROR!</p><br>';
                        }
                        else  if($_GET['error']=="wrongpwd"){
                            echo'<p style="color:red;">Incorrect Password!</p><br>';
                        }
                        else  if($_GET['error']=="nouser"){
                            echo'<p style="color:red;">Invalid username!</p><br>';
                        }
                    }
                     ?>
                    <input type="text" name="mailuid"  placeholder="Username/email">
                    <input type="password" name="pwd"  placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                    <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
                  </form>
                </div>
              </div>
            
           <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
           <script src="header.js"></script> -->
           
</body>
</html>
