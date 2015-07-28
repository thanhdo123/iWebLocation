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
	<title>Home</title>
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
<?php
	//include config.php file
    require_once('config.php');
?>

<body>
	<section id="container">
		<!--header start-->
		<?php include "header.php"; ?>
		<!--header end-->
		<!--sidebar start-->
		<?php include "sidebar.php"; ?>
		<!--sidebar end-->
		<!--main content start-->
		<section id="main-content" align="center" style="padding-top:100px">
			<div class="row">
				
			<?php
			$stmt = $conn->prepare("SELECT * FROM users where Status = 1");
			
			//execute the SQL query and return records
			$stmt->execute();
			$resultrs = $stmt->get_result();
			$index = 0;
			while($row=mysqli_fetch_assoc($resultrs)){
				?>
					<div class="col-sm-6" style="margin-top:10px;">
						<div class="col-sm-6">
							<a href="user_location.php?id=<?php echo $row['ID']?>"><img src="<?php echo $row['MobileType'].'.png'?>"/></a>
						</div>
						<div class="col-sm-6" align="left">
							<a href="user_location.php?id=<?php echo $row['ID']?>"><h3><?php echo $row['UserName']?></h3></a>
							<br/>
							&#x260E; <?php echo $row['PhoneNumber']?>
							<br/>
							<div style="float:left">
								<a href="user_location.php?id=<?php echo $row['ID']?>"><img src="img/search-icon.png" alt="Delete User"/></a>
								<a href="delete_user.php?id=<?php echo $row['ID']?>"><img src="delete.png" alt="Delete User"/></a>
							</div>
						</div>
					</div>
				<?php
			}
			?>
			</div>
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