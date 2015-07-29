<?php

//include config.php file
require_once('config.php');
	
if (isset($_GET['content'])){
	//Latitude_Longitude_UserName
	$content = $_GET['content'];
	//parse
	$pieces = explode("_", $content);
	$date = date('Y-m-d H:i:s');
	//update DB
	//echo "update users set Latitude = ?, Longitude = ?, UpdateDateTime = ? where  UserName = ?";
	//echo "$pieces[0], $pieces[1], $date, $pieces[2]";
	
	$stmt = $conn->prepare("update users set Latitude = ?, Longitude = ?, UpdateDateTime = ? where  UserName = ?");
	$stmt->bind_param("ddss", $pieces[0], $pieces[1], $date, $pieces[2]);	
	$stmt->execute();
}
?>