<?php 
session_start();
if (@$_SESSION['uemail']!="")
{
include '/global/userlogin_header.php'; 
?>
<?php 
  if(@$_SESSION['message']!=""){
echo @$_SESSION['message'];
@$_SESSION['message']="";
  }  ?>
<?php

 $con=mysqli_connect("localhost","root","","mess_db_2") OR die('Error: '.mysqli_connect_error());
 $sql1="SELECT * FROM userinfo WHERE uemail='$_SESSION[uemail]'";
 $result1=mysqli_query($con,$sql1);

 while ($row=mysqli_fetch_array($result1))
{
  $mid=$row ['mid'];
}

$sql2="SELECT * from userinfo WHERE mid='$mid'";
$result2=mysqli_query($con,$sql2);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Supermarket List</title>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 70%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>
<div align="center">
<form action="supermarket_list_view_action.php" method="POST">
   <h4>Members: <select name="uid" required>
     <?php while($row = mysqli_fetch_array($result2)):;?>
      <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
       <?php endwhile;?>
     </select>
  </h4>
  <h4>Date:
  <input type="date" name="date" required>
  </h4>
  <h4>Expense
  <input type="text" name="expense">
  </h4>

  <button type="submit" name="marketbtn" value="MARKET">Submit</button>
</form>
</div>

<?php

$sql3="SELECT * FROM super_market_list WHERE mid='$mid'";
$result3=mysqli_query($con,$sql3);

echo "<div align='center'>";
echo "<table align='center'>";
echo "<tr> <th>Name</th> <th> Date</th>  <th> Expense</th> <th> Edit</th> <th> Delete</th>    ";
echo "</tr>";
while ($row=mysqli_fetch_array($result3))
{
  echo "<tr>";//opens row
  echo "<td>" .$row ['uname']. "</td>";
  echo "<td>" .$row ['date']. "</td>";
  echo "<td>" .$row ['expense']. "</td>";
  //echo "<td><a href='#'><button>Add Member</button></a></td>";
  echo "<td><a href=\"edit_supermarket_list.php?uid=".$row['uid']."&date=".$row['date']."\">Edit</a></td>";
  echo "<td><a href=\"delete_supermarket_list.php?uid=".$row['uid']."&date=".$row['date']."\">Delete</a></td>";
  //."?date=".$row['date'].
  //echo "<td><a href='#'>Edit</a></td>";
  echo '<br>';
  echo "</tr>";
}
echo "</table>";

echo "</div>";



?>

<?php include '/global/userlogin_footer.php'; 
}else{
	header('Location: index.php');
}
?>

</body>
</html>