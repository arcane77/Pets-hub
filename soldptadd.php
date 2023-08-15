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
  <title>
  SALES DETAILS
  </title>
<style>
  
  body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background:rgb(232, 221, 193) ;
}
.topnav {
  overflow: hidden;
  background-color: rgb(152, 116, 112) ;
  height: 70px;
 
}

.topnav a {
  float: left;
  color: rgb(232, 221, 193);
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
  padding: 14px 7px 4px 15px;
  text-decoration: none;

}


fieldset { max-width: 450px;
  background: #FAFAFA;
	padding: 30px;
	margin: 50px auto;
	box-shadow: 1px 1px 25px rgb(232, 221, 193);
	border-radius: 10px;
	border: 4px solid rgb(152, 116, 112);


}

</style>
  </head>
<body>
<div class="brand">
            <a class="active" href="home.html"><img src="logo.png"></a>
</div>
<div class="topnav">
            
            <a href="sales.php">Sales details</a>
          </div>
<form>
    <button type="submit" formaction="soldpets.php" style="margin:15px;height: 30px;width: 100px;
    border-radius:10px;
border: 2px solid black;background-color:rgb(152, 116, 112);color:#f2f2f2;font-size:15px;cursor:pointer;">Back</button>
</form>  
<form method="post" action="soldptadd.php"> 
<fieldset> 
   <input type="text" name="id" placeholder="Enter sales details id" style="width:100%;height:30px;
    border: 2px solid rgb(152, 116, 112); border-radius:5px;  background:transparent;" required>
  <br><br>
  <input type="text" name="cs_id" placeholder="Enter customer id" style="width:100%;height:30px;
    border: 2px solid rgb(152, 116, 112); border-radius:5px;  background:transparent;" required>
  <br><br>
   <input type="text" name="pp" placeholder="Enter pet  id" style="width:100%;height:30px;
    border: 2px solid rgb(152, 116, 112); border-radius:5px;  background:transparent;" required>
  <br><br>
  <input type="submit" name="submit" value="ADD" style="width:100%;height:34px;
    border: 2px solid black; border-radius:10px; cursor:pointer;background-color: rgb(152, 116, 112)">&ensp;  
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
$pet_id = $_POST["pp"];
$cs_id = $_POST["cs_id"];




$sql = "INSERT INTO sold_pets( sd_id,cs_id,pet_id)
VALUES ('$id','$cs_id','$pet_id')";
if ($conn->query($sql) == TRUE) {
  echo'<div>
  <h1 style="color:#404040;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;">New record of sales_id='
  .$id.'and pet_id='.$pet_id. ' inserted successfully</h1>
     </div>';
    $conn->query("call calculations_for_pets('$pet_id','$id','$cs_id')");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}

?>