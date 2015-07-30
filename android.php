<?php
	session_start();
    if (!isset($_SESSION["USER_TYPE"]) || $_SESSION["USER_TYPE"] != "admin"){ 
	    //go to index page
		header("location: index.php");
		exit();	
    }	 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Android</title>
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
		<section id="main-content" align="center">
			<section class="wrapper" align="left">
				<!-- page start-->
				<div class="row">
					<div class="col-md-12">
						<section class="panel">
							<header class="panel-heading"> Android </header>
							<div align="center">
								<img src="img/android.png" alt="" height="200" width="200">			
							</div>
							<div align="center" style="margin-top:20px">
								<a href="download/android.apk" download><img src="download.jpg" alt="" height="100" width="300"></a>			
							</div>
						</section>
					</div>
				</div>
			</section>
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