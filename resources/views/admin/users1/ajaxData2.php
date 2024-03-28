<?php

$conn = mysqli_connect("localhost","root","","db_sapp");
//global $conn;
$idbahagian = isset($_POST['idbahagian'])  ? $_POST['idbahagian'] : 0;
$command = isset($_POST['get'])  ? $_POST['get'] : "";

switch($command){
case "idbahagian":
$statement = "SELECT id, bahagian FROM tbahagian";
$dt=mysqli_query($conn,$statement);
while($result=mysqli_fetch_array($dt))
{
	echo $result1 = "<option value=".$result['id'].">" .$result['bahagian']. "</option>";
}
break;
	
case "idunit":
$result1 ="<option>--Sila Pilih--</option>";
$statement = "SELECT * FROM tunit WHERE idbahagian=".$idbahagian;
$dt=mysqli_query($conn,$statement);

while($result=mysqli_fetch_array($dt))
{
	 $result1 .= "<option value=".$result['id'].">" .$result['unit']. "</option>";
}
echo $result1;
break;


}

exit();

?>