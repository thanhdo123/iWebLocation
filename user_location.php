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
	$Os = "";
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
		$Os = $row['MobileType'];
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>User Location</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-reset.css" rel="stylesheet">
	<!--external css-->
	<link href="css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="css/jquery-ui.css" rel="stylesheet" />
	<link href="css/tasks.css" rel="stylesheet" />

	<!--right slidebar-->
	<link href="css/slidebars.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/style-responsive.css" rel="stylesheet" />
	<link href="css/jquery-ui.css" rel="stylesheet" />
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
	<style>
      #map-canvas {
        width: 100%;
        height: 700px;
      }
	  div {
			margin: 20px auto;
			text-align: center;
			font-family: 'Helvetica Neue', sans-serif;
		}

		.label {
			padding: 1px 3px 2px;
			font-size: 18px;
			font-weight: bold;
			color: #ffffff;
			text-transform: uppercase;
			white-space: nowrap;
			background-color: #bfbfbf;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
		}
		.label.important {
			background-color: #c43c35;
		}
		.label.warning {
			background-color: #f89406;
		}
		.label.success {
			background-color: #46a546;
		}
		.label.notice {
			background-color: #62cffc;
		}
    </style>
</head>

<body>
	<section id="container">
		<!--header start-->
		<?php include "header.php"; ?>
		<!--header end-->
		<!--sidebar start-->
		<?php include "sidebar.php"; ?>
		<!--sidebar end-->
		<!--main content start-->
		<section id="main-content" align="center" style="padding-top:80px">
			<div id="user-info" style="padding-top:15px">
				<span class="label success"><?php echo $FirstName; ?> <?php echo $LastName; ?></span>
				<span class="label notice"><?php echo $PhoneNumber; ?></span>
				<span class="label important"><?php echo $Os; ?></span>
			</div>
			<div id="map-canvas"></div>
		</section>
		<!--main content end-->
	</section>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="js/jquery.scrollTo.min.js"></script>
	<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/angular.min.js"></script>
	<!--right slidebar-->
	<script src="js/slidebars.min.js"></script>
	<!--common script for all pages-->
	<script src="js/common-scripts.js"></script>
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