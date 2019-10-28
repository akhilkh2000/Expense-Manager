<?php 

$severname= "localhost";
$dBUsername="root";
$dBPassword="";
$dBName="loginsystem";

$conn=mysqli_connect($severname,$dBUsername,$dBPassword,$dBName);
if(!$conn){
    die("Connection Failed!" .mysqli_connect_error());
}
 ?>