<?php
$connection = mysqli_connect("localhost", "root", "", "android_api");

if (!$connection){
	echo "failed to connect";
}

if (isset($_POST['user_id']) && isset($_POST['shop_id']) && isset($_POST['product_id'])) {
	$user_id = $_POST["user_id"];
	$shop_id = $_POST["shop_id"];
	$product_id = $_POST["product_id"];
}
	else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (user, shop or product) is missing!";
    echo json_encode($response);
}
$sql = ("INSERT INTO cart_1(user_id,shop_id,product_id) VALUES ('$user_id','$shop_id','$product_id')");

$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));

if($result){
	echo "added to cart";
}
else{
	echo "Failed";
}
mysqli_close($connection);

?>