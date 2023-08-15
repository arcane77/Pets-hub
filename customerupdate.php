<?php
 session_start();
 if(isset($_SESSION['user']))
 {

 }
 else{
  echo"<script>location.href='login.html'</script>";
 }
?>
<!doctype html>
<html>
<head>
        <title>CUSTOMER </title>
        <style>
            body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background:rgb(232, 221, 193) ;
}
.topnav {
  overflow: hidden;
  background-color:rgb(152, 116, 112);
  height: 70px;

}

.topnav a {
  float: left;
  color: rgb(232, 221, 193);
  padding:18px 14px 14px 0px ;
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
  padding: 14px 7px 4px 15px;
  text-decoration: none;

}

fieldset { 
  background: #FAFAFA;
	padding: 10px;
   margin:auto;
   max-width:450px;
	box-shadow: 1px 1px 25px  rgb(232, 221, 193);
	border-radius: 10px;
	border: 4px solid rgb(152, 116, 112) ;


}

</style>    
</head>
<body>
<div class="brand">
            <a class="active" href="home.html"><img src="logo.png"></a>
</div>
<div class="topnav">
            
            <a href="customer.php">CUSTOMERS</a>
          </div>
   <form>
       <button type="submit" formaction="customer.php" style="margin:15px;height: 30px;width: 90px;
       border-radius:10px;
border: 2px solid black;background-color: rgb(152, 116, 112);color:#f2f2f2;font-size:15px;cursor:pointer;">back</button>
</form> 
<form method="post" action="customerupdate.php">  
<fieldset>
<input type="text" name="id" placeholder="Enter the customer id" style="width:100%;height:30px;
    border: 2px solid  rgb(152, 116, 112); border-radius:5px; background:transparent;" required>
  <br><br>
 <input type="text" name="fname" placeholder="Enter customer first_name" style="width:100%;height:30px;
    border: 2px solid  rgb(152, 116, 112); border-radius:5px; background:transparent;" required>
  <br><br>
   <input type="text" name="mname" placeholder="Enter customer middle_name" style="width:100%;height:30px;
    border: 2px solid  #b40a70; border-radius:5px; background:transparent;" required>
  <br><br>
   <input type="text" name="lname" placeholder="Enter customer last_name" style="width:100%;height:30px;
    border: 2px solid rgb(152, 116, 112); border-radius:5px; background:transparent;" required>
  <br><br>
  <input type="text" name="address" placeholder="Enter customer address" style="width:100%;height:30px;
    border: 2px solid  rgb(152, 116, 112); border-radius:5px; background:transparent;" required>
  
  <br><br>
  <input type="numbers" name="phone" placeholder="Enter phone number" style="width:100%;height:30px;
    border: 2px solid  rgb(152, 116, 112); border-radius:5px; background:transparent;" required>
    <br><br>
  <input type="submit" name="submit" value="update" style="width:100%;height:34px;
    border: 2px solid  black; border-radius:10px; cursor:pointer;background-color: rgb(152, 116, 112)">  
  </fieldset>
</form> 
</body>
</html>
<?php
if(isset($_POST["submit"]))
{
// define variables and set to empty values
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
$id = $_POST["id"];
  $fname = $_POST["fname"];
  $mname= $_POST["mname"];
  $lname = $_POST["lname"];
  $address = $_POST["address"];


  $Query2="select count(*) from customer where cs_id='$id'";
  $Execute = mysqli_query($conn,$Query2);
  $count = mysqli_fetch_row($Execute);
  if($count[0]==1)
  {
    $sql = "UPDATE customer set cs_fname='$fname',cs_mname='$mname' ,cs_lname='$lname' ,cs_address='$address'
    where cs_id='$id'";
  if ($conn->query($sql) == TRUE) {
    echo'<div>
    <h1 style="color:#404040;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;">'
    .$id. ' updated successfully</h1>
       </div>';
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  }
  else{
    echo '<div>
    <h1 style="color:#404040;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;">Given cs_id not found</h1>
       </div>';
}


$conn->close();
}
?>