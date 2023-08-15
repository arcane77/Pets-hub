<html>
<head>
        <title>CUSTOMER</title>
        <style>
            body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background: rgb(232, 221, 193);
}
.topnav {
  overflow: hidden;
  background-color:rgb(152, 116, 112);
  height: 70px;

}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 18px 14px 14px 0px;
  text-decoration: none;
  font-size: 33px;
  font-weight: bold;
}
.brand {
  overflow: hidden;
  background-color:rgb(152, 116, 112);
 
  float: left;
  color: rgb(232, 221, 193);
  text-align: left;
  padding: 14px 7px 8px 15px;
  text-decoration: none;

}
</style>

    <body>
    
    <div class="brand">
            <a class="active" href="home.html"><img src="logo.png"></a>
</div>
    <div class="topnav">
            
            <a href="customer.php">CUSTOMERS</a>
            
          </div>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Petshop_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "  CONNECTION ESTABLISHED \r\n";
//echo "  INSERTION IN PROCESS";
$cs_id=$_POST["t1"];
$Query2="select count(*) from customer where cs_id='$cs_id'";
$Execute = mysqli_query($conn,$Query2);
$count = mysqli_fetch_row($Execute);
if($count[0]==1)
{
    $sql = "DELETE FROM customer WHERE cs_id='$cs_id'";
    if ($conn->query($sql) == TRUE) {
        echo '<div>
        <h1 style="color:#404040;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;">Data deleted successfully</h1>
           </div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}
else{
    echo '<div>
    <h1 style="color:404040;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;"> Data not found</h1>
       </div>';
}


$conn->close();
?>
 <form>
       <button type="submit" style="height: 50px;width:90px;margin-left:10px;cursor:pointer;border-radius:10px;
border: 2px solid  black;background-color:rgb(152, 116, 112);color:#f2f2f2;font-size:15px;" formaction="customer.php">back</button>
</form> 
</body>
</html>