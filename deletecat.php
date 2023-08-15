<!doctype html>
<html>
<head>
        <title>cats</title>
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
  color: rgb(232, 221, 193);
  text-align: center;
  padding: 18px 14px 14px 0px;
  text-decoration: none;
  font-size: 35px;
  font-weight: bold;
}
</style>
    <body>
    <div class="topnav">
            <a class="active" href="home.html"><img src="logo.png"></a>
            <a href="cats.php">CATS</a>
           
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
$pet_id=$_POST["t1"];
$Query2="select count(*) from pets where pet_id='$pet_id'";
$Execute = mysqli_query($conn,$Query2);
$count = mysqli_fetch_row($Execute);

if($count[0]==1)
{
    $sql = "DELETE FROM pets WHERE pet_id='$pet_id'";
    if ($conn->query($sql) == TRUE) {
        echo '<div>
        <h1 style="color:#404040;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;">Data deleted successfully</h1>
           </div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}
else{
    echo '<div>
    <h1 style="color:#000;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;"> Data not found</h1>
       </div>';
}

$conn->close();
?>
<form>
    <button type="submit"  style=" height: 50px;width: 90px;margin-left:10px;cursor:pointer;border-radius:10px;
border: 2px solid black;background-color:rgb(152, 116, 112);color:#f2f2f2;font-size:17px;" formaction="cats.php">Back</button>
</form>
</body>
</html>