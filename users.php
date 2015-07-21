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
	<title>iWebLocation</title>
	<link rel="stylesheet" type="text/css" href="project.css">
</head>
<?php
	//include config.php file
    require_once('config.php');
?>

<body>
	<div id="wrapper">
		<header id="header">
			<img src="banner.png" alt="banner">
		</header>
		<nav id="menu">
			<?php include "menu.php"; ?>
		</nav>
		<section id="content">
			<?php
			$stmt = $conn->prepare("SELECT * FROM users where Status = 1");
			
			//execute the SQL query and return records
			$stmt->execute();
			$resultrs = $stmt->get_result();
			$index = 0;
			while($row=mysqli_fetch_assoc($resultrs)){
				?>
					<div class="user">
						<div class="user_img">
							<a href="user_location.php?id=<?php echo $row['ID']?>"><img src="<?php echo $row['MobileType'].'.png'?>"/></a>
						</div>
						<div class="user_info">
							<a href="user_location.php?id=<?php echo $row['ID']?>"><?php echo $row['UserName']?></a>
							<br/>
							&#x260E; <?php echo $row['PhoneNumber']?>
							<br/>
							<a href="delete_user.php?id=<?php echo $row['ID']?>"><img src="delete.png" alt="Delete User"/></a>
						</div>
					</div>
				<?php
			}
			?>
            <div class="clearBoth"></div>
		</section>
		<footer>
			<?php include "footer.php"; ?>
		</footer>
	</div>
</body>
</html>