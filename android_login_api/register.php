register.php
<?php

 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])
	&& isset($_POST['address']) && isset($_POST['phone'])) {
 
    // receiving the post params
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	$address = $_POST['address']; 
	$phone = $_POST['phone']; 
 
    // check if user is already existed with the same email
    if ($db->isUserExisted($email)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $email;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->storeUser($name, $email, $password, $address, $phone);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["unique_id"] = $user["unique_id"];
            $response["users"]["name"] = $user["name"];
            $response["users"]["email"] = $user["email"];
			$response["users"]["address"] = $user["address"];
            $response["users"]["phone"] = $user["phone"];
            $response["users"]["created_at"] = $user["created_at"];
            $response["users"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration! phone must be unique";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}
?>