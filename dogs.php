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
    border-collapse: collapse;
    background: #FAFAFA;
    width:50%;
    margin: 2px auto;
}

td, th {
    border: 2px solid #dddddd;
    text-align: left;
    padding: 8px;
}
th{
  background-color: rgb(152, 116, 112);
}


.custombutton{
  margin:25px;
  
}input[type=text] {
    width: 15%;
    padding: 12px 20px;
    margin-left:593px ;
    background:transparent;
    border: 2px solid black;
    color:solid black;
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
 <div class="custombutton">   
<form>
<button  style="  height: 50px;width: 150px;cursor:pointer;border-radius:10px;
border: 2px solid black;background-color:rgb(152, 116, 112);color:#f2f2f2;font-size:17px;"formaction="dogsadd.php">add new 
dog</button>

<button   style="height: 50px;width: 150px;cursor:pointer;border-radius:10px;
border: 2px solid black;background-color: rgb(152, 116, 112);color: #f2f3f2;font-size:17px;" 
formaction="dogsupdate.php">update dogs</button>
</form>
</div>
    <?php
   
$con = mysqli_connect("localhost","root","","Petshop_management");
if(!$con)
{ 
die("could not connect".mysql_error());
}
$var=mysqli_query($con,"select P.pet_id,P.pet_category,A.weight,A.height,A.age,A.fur,P.cost from pets P,dogs A where P.pet_id=A.pet_id ");
echo "<table border size=10>";
echo "<tr>
<th>pet_ID</th>
<th>petcategory</th>

<th>weight(kg)</th>
<th>height(cm)</th>
<th>age(m)</th>
<th>fur</th>
<th>cost(Rs)</th>
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
    <td>$arr[6]</td>
   
    </tr>";}
    echo "</table>";
    mysqli_free_result($var);
}

mysqli_close($con);
    
    
?>

<div class="lastblock" style="margin-top:25px;">
<form action="deletedog.php" method="post">
    <input  id="dbutton" type="text" name="t1" placeholder="Enter the id to delete" required>
    <input  style="width:75px;height:44px;cursor:pointer;border-radius:10px;
border: 2px solid black;background-color: rgb(152, 116, 112);color:#f2f2f2;font-size:17px;"type="submit" value="delete">
</form> 
</div>
</body>
</html>