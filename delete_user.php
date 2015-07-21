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
	
	//if submit is clicked
	if(isset($_POST['Submit'])){
		$UserID = ($_POST['UserID']);		
		$stmt = $conn->prepare("delete from users where ID = ?");
		$stmt->bind_param("d", $UserID);	
		$stmt->execute();
		
		//go to users page			
		header("location: users.php");
	}else if(isset($_POST['Cancel'])){
		//go to users page			
		header("location: users.php");
	}
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
			Are you sure to delete user? <br/>
			<form  method="post" action="delete_user.php">
				<table cellpadding="20">
                	<tr>   
						<td>
							<input type="hidden" id="UserID" name="UserID" value="<?php echo $_GET['id']?>>"/>
							<input type="submit" id="Submit" name="Submit" value="Delete" class="submitBtn" />
							<input type="submit" id="Cancel" name="Cancel" value="Cancel" class="submitBtn" />
						</td>
                    </tr>
                </table>
            </form>
            <div class="clearBoth"></div>
		</section>
		<footer>
			<?php include "footer.php"; ?>
		</footer>
	</div>
</body>
</html>