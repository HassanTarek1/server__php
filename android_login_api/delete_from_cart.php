<?php
$connection = mysqli_connect("localhost", "root", "", "android_api");

$id = $_POST["id"];
	
$sql = "DELETE FROM cart_1 WHERE id='$id'";

$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));

if($result){
	echo "DATA DELETED";
}
else{
	echo "Failed";
}
mysqli_close($connection);

?>