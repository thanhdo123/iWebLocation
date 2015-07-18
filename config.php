<?php
//get connection
$conn = mysqli_connect('localhost', 'root', '123456', 'iweblocation');
if (mysqli_connect_errno()) {
	echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}
?>