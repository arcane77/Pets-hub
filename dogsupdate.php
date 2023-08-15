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
<title>DOGS</title>
<style>
  body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background: rgb(232, 221, 193);
  }
.topnav {
  overflow: hidden;
  background-color: rgb(152, 116, 112);
  height: 70px;
}

.topnav a {
  float: left;
  color:rgb(232, 221, 193);
  text-align: center;
  padding:18px 14px 14px 0px;
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
	background: white;
	padding: 10px;
   margin:auto;
   max-width:593px;
	box-shadow: 1px 1px 25px  rgb(232, 221, 193);
	border-radius: 10px;
	border: 6px solid rgb(152, 116, 112);


}
</style>
</head>
<body>
<div class="brand">
            <a class="active" href="home.html"><img src="logo.png"></a>
</div>
<div class="topnav">
            <a href="dogs.php">DOGS</a>
          </div>
<form>
    <button type="submit"  formaction="dogs.php" style="margin:15px;height: 30px;width: 100px;cursor:pointer;border-radius:10px;
border: 2px solid black;background-color: rgb(152, 116, 112);color:#f2f2f2;font-size:17px;">Back</button>
</form> 
<form method="post" action="dogsupdate.php">  
<fieldset>
<input type="text" name="id" placeholder=" Enter pet_id" style="width:100%;height:30px;
   border: 2px solid rgb(152, 116, 112); border-radius:3px;background:transparent;" required  >
    <br><br>
   <input type="text" name="category" placeholder="Enter pet_category" style="width:100%;height:30px;
   border: 2px solid rgb(152, 116, 112); border-radius:3px;background:transparent;" required  >
   <br><br>
  
  
  <input type="number" step=any name="weight"  placeholder="Enter weight" style="width:280px;height:30px;
   border: 2px solid  rgb(152, 116, 112); border-radius:3px;background:transparent;" min="1" required  >
  <br><br>
 <input type="number" step=any name="height"  placeholder="Enter height" style="width:300px;height:30px;
   border: 2px solid rgb(152, 116, 112); border-radius:3px;background:transparent;" min="15" required >
  <br><br>
  <input type="number" name="age"  placeholder="Enter age" style="width:280px;height:30px;
   border: 2px solid rgb(152, 116, 112); border-radius:3px;background:transparent;"  min="1"required >
  <br><br>
  <input type="text" name="fur"  placeholder="Enter fur" style="width:300px;height:30px;
   border: 2px solid rgb(152, 116, 112); border-radius:3px;background:transparent;"  required >
  <br><br>
  <input type="number" name="cost"  placeholder="Enter cost" style="width:100%;height:30px;
   border: 2px solid rgb(152, 116, 112); border-radius:3px;background:transparent;" min="0"  required >
  <br><br>
  <input type="submit" name="submit" value="update" style="width:100%;height:34px;
   border: 2px solid black; border-radius:10px;cursor:pointer;background-color: rgb(152, 116, 112)" >&ensp; 
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
  $category = $_POST["category"];

  $weight = $_POST["weight"];
  $height = $_POST["height"];
  $age = $_POST["age"];
  $fur= $_POST["fur"];
  $cost = $_POST["cost"];

  $Query2="select count(*) from pets where pet_id='$id'";
  $Execute = mysqli_query($conn,$Query2);
  $count = mysqli_fetch_row($Execute);

  if($count[0]==1)
  {
    $sql = "UPDATE pets SET pet_category='$category' ,cost='$cost' WHERE pet_id='$id';
    UPDATE dogs SET ,weight='$weight',height='$height',age='$age',fur='$fur' WHERE pet_id='$id'";
    if ($conn->multi_query($sql) == TRUE) {
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
    <h1 style="color:#404040;font-size:30px; font-family: "Roboto", sans-serif;margin:auto;">Given pet_id not found</h1>
       </div>';
}


$conn->close();
}

?>