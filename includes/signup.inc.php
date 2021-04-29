<?php 
if(isset($_POST['signup-submit'])){

require "dbh.inc.php";


$username=$_POST['uid'];
$email=$_POST['mail'];
$passsword=$_POST['pwd'];
$passwordRepeat=$_POST['pwd-repeat'];
$startBalance=$_POST['startBalance'];
$budget=$_POST['budget'];

if (empty($passwordRepeat)||empty($username)||empty($email)||empty($passsword)||empty($budget)||empty($startBalance)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/", $username)){

    header("Location: ../signup.php?error=Invalidmailuid");
    exit();
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();

}
else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();

}
else if($passsword!==$passwordRepeat){
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);

}
else{
    $sql="SELECT uidUsers FROM users WHERE uidUsers=? OR emailUsers=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../signup.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt,"ss",$username,$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck=mysqli_stmt_num_rows($stmt);
        if($resultCheck>0){
            header("Location: ../signup.php?error=usertaken");
        exit();
        }
        else{
            $sql="INSERT INTO users (uidUsers,emailUsers,pwdUsers,startBalance,budget) VALUES (?,?,?,$startBalance,$budget)";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else{
                $hashedPwd=password_hash($passsword, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashedPwd);
                mysqli_stmt_execute($stmt);
                header("Location: ../signup.php?error=success");
                exit();
            }
        }
    }

 }
 mysqli_stmt_close($stmt);
 mysqli_close($conn);
}
else{
    header("Location: ../index.php");
    exit();
}
