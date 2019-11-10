 <?php
session_start();

 if(!isset($_SESSION['userId'])){
     header('location: ../login/includes/logout.inc.php');
 }
 else{
    echo '<p>you are logged in!</p>';
    echo 'User Id: '. $_SESSION['userId'];
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    


<form action="includes/logout.inc.php" method="post">
                   <button type="submit" name="logout-submit">Logout</button>
               </form>
    
    
</body>
</html>