<?php
	session_start();  
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
			
			Please download program and install on your phone
			
			<a href="program.apk">Program</a>
            	
            <div class="clearBoth"></div>
		</section>
		<footer>
			<?php include "footer.php"; ?>
		</footer>
	</div>
</body>
</html>