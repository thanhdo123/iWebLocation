<?php
	session_start();
    if (!isset($_SESSION["USER_TYPE"]) || $_SESSION["USER_TYPE"] != "admin"){ 
	    //go to index page
		header("location: index.php");
		exit();	
    }	 
?>

<?php
	//include config.php file
    require_once('config.php');
?>

<?php
	$Latitude = 0;
	$Longitude = 0;
	$FirstName = "";
	$LastName = "";
	$PhoneNumber = "";
	$stmt = $conn->prepare("SELECT * FROM users where Status = 1 and ID = ".$_GET['id']);
	
	//execute the SQL query and return records
	$stmt->execute();
	$resultrs = $stmt->get_result();
	$index = 0;
	if($row=mysqli_fetch_assoc($resultrs)){
		$Latitude = $row['Latitude'];
		$Longitude = $row['Longitude'];
		
		$FirstName = $row['FirstName'];
		$LastName =  $row['LastName'];
		$PhoneNumber = $row['PhoneNumber'];
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>iWebLocation</title>
	<link rel="stylesheet" type="text/css" href="project.css">
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
	<style>
      #map-canvas {
        width: 100%;
        height: 700px;
      }
    </style>
</head>

<body>
	<div id="wrapper">
		<header id="header">
			<img src="banner.png" alt="banner">
		</header>
		<nav id="menu">
			<?php include "menu.php"; ?>
		</nav>
		<section id="content">
			<div id="map-canvas"></div>
            <div class="clearBoth"></div>
		</section>
		<footer>
			<?php include "footer.php"; ?>
		</footer>
	</div>
</body>
</html>

<script>
var map;
function initialize() {
	var mapOptions = {
		zoom: 15
	};
	var content = '<?php echo $FirstName?>' + ' ' + '<?php echo $LastName?>' + '<br/>' + '&#x260E; <?php echo $PhoneNumber?>';
	map = new google.maps.Map(document.getElementById('map-canvas'),  mapOptions);
	var options = {
		map: map,
		position: new google.maps.LatLng(<?php echo $Latitude?>, <?php echo $Longitude?>),
		content: content
	};

	var infowindow = new google.maps.InfoWindow(options);
	map.setCenter(options.position);
	
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>