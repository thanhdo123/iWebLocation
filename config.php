<?php
//get connection
$conn = mysqli_connect('sql207.byethost7.com', 'b7_16374229', '123456778', 'b7_16374229_gnc');
if (mysqli_connect_errno()) {
	echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
}
?>