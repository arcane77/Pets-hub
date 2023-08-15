<?php
session_start();
//welcome script 
if($_POST["t1"]=="anjali"&&$_POST["t2"]=="2446")
{
     $_SESSION['user']="anjali";
    $con = mysqli_connect("localhost","root","","Petshop_management");
if(!$con)
{ 
die("could not connect database".mysql_error());
}
  
else
{
    echo"<script>location.href='home.html'</script>";
}
}
else
{
    echo"<script>location.href='login.html'</script>";
}

?>

