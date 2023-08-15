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
        <title>CUSTOMER</title>
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
    width:50%;
    margin: 2px auto;
    background: #FAFAFA;
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
    border: 2px solid black;
    background:transparent;        
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
          <div class="custombutton">         
<form>
<button   style=" height: 50px;width: 150px;cursor:pointer;border-radius:10px;
background-color: rgb(152, 116, 112);color:#f2f2f2;font-size:15px;" formaction="customeradd.php">Add new customer</button>
<button   style=" height: 50px;width: 150px;cursor:pointer;border-radius:10px;
background-color:rgb(152, 116, 112) ;color:#f2f2f2;font-size:15px;" formaction="customerupdate.php">update customer</button>

</form>
</div>
    <?php
   
$con = mysqli_connect("localhost","root","","Petshop_management");//change username and password according to your server settings
if(!$con)
{ 
die("could not connect".mysql_error());
}
$var=mysqli_query($con,"select * from customer ");
echo "<table>";
echo "<tr>
<th>cs_ID</th>
<th>cs_fname</th>
<th>cs_mname</th>
<th>cs_lname</th>
<th>cs_address</th>
<th>phone(10)</th>
</tr>";
if(mysqli_num_rows($var)>0){
    while($arr=mysqli_fetch_row($var))
    { echo "<tr>
    <td>$arr[0]</td>
    <td>$arr[1]</td>
    <td>$arr[2]</td>
    <td>$arr[3]</td>
    <td>$arr[4]</td>
    <td>$arr[5]</td>
    </tr>";}
    echo "</table>";
    mysqli_free_result($var);
}

mysqli_close($con);
    
    
?>
<div class="lastblock" style="margin-top:25px;">
<form action="deletecustomer.php" method="post">
<input  id="dbutton" type="text" name="t1" placeholder="Enter the id to delete" required>
    <input  style="width:75px;height:44px;cursor:pointer;border-radius:10px;
border: 2px solid black;background-color: rgb(152, 116, 112);color:#f2f2f2;font-size:15px;"type="submit" value="Delete">
</form> 
</div>
</body>
</html>