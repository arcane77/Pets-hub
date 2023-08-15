<?php
 session_start();
 if(isset($_SESSION['user']))
 {

 }
 else{
  echo"<script>location.href='login.html'</script>";
 }
?>
<html>
    <head>
        <title>SALES DETAILS</title>
        <style>

            body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background: rgb(232, 221, 193);
}
.topnav {
  overflow: hidden;
  background-color:rgb(152, 116, 112) ;
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
  padding: 14px 7px 8px 15px;
  text-decoration: none;

}

table {
    font-family: arial, sans-serif;
    background: #FAFAFA;
    width: 100%;
 
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
th{
    background-color:rgb(152, 116, 112);
}


.custombutton{
  margin:25px;
  
}input[type=text] {
    width: 15%;
    padding: 12px 20px;
    margin-left:593px ;
    background:transparent;
    border: 2px solid black;
}
    </style>    
</head>
<body>
<div class="brand">
            <a class="active" href="home.html"><img src="logo.png"></a>
</div>
<div class="topnav">
           
            <a href="soldpets.php">sold pets</a>
          </div>
          <div class="custombutton">        
<form>
<button   style=" height: 50px;width: 90px;cursor:pointer;border-radius:10px;
border: 2px solid black;background-color: rgb(152, 116, 112);color:#f2f2f2;font-size:15px;" formaction="sales.php">Back</button>
<button   style=" height: 50px;width: 150px;cursor:pointer;border-radius:10px;
border: 2px solid black;background-color: rgb(152, 116, 112);color:#f2f2f2;font-size:15px;" formaction="soldptadd.php">Add new details</button>
</form>
</div>
<?php
   
$con = mysqli_connect("localhost","root","","Petshop_management");
if(!$con)
{ 
die("could not connect".mysql_error());
}
$var=mysqli_query($con,"select * from sold_pets ");
echo "<table border size=10>";
echo "<tr>
<th>sd_ID</th>
<th>cs_id</th>
<th>pet_id</th>
</tr>";
if(mysqli_num_rows($var)>0){
    while($arr=mysqli_fetch_row($var))
    { echo "<tr>
    <td>$arr[0]</td>
    <td>$arr[1]</td>
    <td>$arr[2]</td>
    </tr>";}
    echo "</table>";
    mysqli_free_result($var);
}

mysqli_close($con);
    
    
?>
<div class="lastblock" style="margin-top:25px;">
<form action="deletesoldpt.php" method="post">
<input  type="text" name="t1" placeholder="Enter  sales_id to delete" required><br><br>
<input  type="text" name="t2" placeholder="Enter  pet_id to delete" required><br><br>
<input   type="text" name="t3" placeholder="Enter cs_id number" required><br><br>
    <input  style="width:75px;height:44px;cursor:pointer;border-radius:10px;margin-left:680px;
border: 2px solid black;background-color:rgb(152, 116, 112);color:#f2f2f2;font-size:15px;"type="submit" value="Delete">
</form> 
</div>
</body>
</html>