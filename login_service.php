<?php

//include config.php file
require_once('config.php');
	
// response Array
$response = array("tag" => "", "success" => 0, "error" => 0, "error_msg" => "");
	
if (isset($_POST['tag']) && $_POST['tag'] != '') {
	$tag = $_POST['tag'];
	$response["tag"] = $_POST['tag'];
	// check for tag type
    if ($tag == 'login') {
        // Request type is check Login
        $username = $_POST['username'];
        $password = $_POST['password'];
		
		$response["username"] = $username;
		$response["username"] = $password;
		
		$stmt = $conn->prepare("SELECT * FROM users where UserName = ? and Password = ? and Status = 1");
		$stmt->bind_param("ss", $username, $password);		
		
		//execute the SQL query and return records
		$stmt->execute();
		$resultrs = $stmt->get_result();
		if($row=mysqli_fetch_assoc($resultrs)){
			$response["success"] = 1;			
			
		}else{
			$response["error"] = 1;
            $response["error_msg"] = "Email or password incorrect!";
		}
	}
}

echo json_encode($response);
?>