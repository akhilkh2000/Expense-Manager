 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Signup</title>
     <link rel="stylesheet" type="text/css" href="signup.css">
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
<form class="register-form"  action="includes/signup.inc.php" method="post">
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error']=="emptyfields"){
                            echo'<p style="color:red;"> Fill in all fields!</p><br>';
                        }
                        else if($_GET['error']=="passwordcheck"){
                            echo'<p style="color:red;"> Passwords don\'t match!</p><br>';
                        }
                        else if($_GET['error']=="usertaken"){
                            echo'<p style="color:red;"> User Exists ,Change email or username!</p><br>';
                        }
                        else if($_GET['error']=="sqlerror"){
                            echo'<p style="color:red;">SQL ERROR!</p><br>';
                        }
                        else if($_GET['error']=="Invalidmailuid"){
                            echo'<p style="color:red;">Invalid mail and username!</p><br>';
                        }
                        else  if($_GET['error']=="invalidmail"){
                            echo'<p style="color:red;">Invalid mail!</p><br>';
                        }
                        else  if($_GET['error']=="invaliduid"){
                            echo'<p style="color:red;">Invalid username!</p><br>';
                        }
                        else  if($_GET['error']=="sqlerror"){
                            echo'<p style="color:red;">SQL ERROR!</p><br>';
                        }
                        else if($_GET['error']=="success"){
                            echo '<p style="color:white";>Your\'e good to go Money lover!</p><br>';
                        }
                    }
                     ?>
                    <input type="text" name="uid" placeholder="Username">
                    <input type="email" name="mail" placeholder="Email">
                    <input type="number" name="startBalance" placeholder="Starting Balance" required>
                    <input type="number" name="budget" placeholder="Budget" required>
                    <input type="password" name="pwd" placeholder="Password">
                    <input type="password" name="pwd-repeat" placeholder="Repeat password">
                    <button type="submit" name="signup-submit">Signup</button>
                    <p class="message">Already registered? <a href="header.php">Sign In</a></p>
                  </form>
 </div>
 </div>

 </body>
 </html>
    
<!-- <?php
    require "footer.php";
?> -->