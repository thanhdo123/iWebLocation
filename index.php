<?php
	session_start();  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>iWebLocation</title>
	<link rel="stylesheet" type="text/css" href="project.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    
    <!--external css-->
   <link href="css/font-awesome.css"  rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css"  rel="stylesheet">
    
    <script src="js/moment.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-1.11.2.min.js" ></script>
	<style> 
	body {
		background: url("bg.jpg");
		background-size: 100% 180%;
		background-repeat: no-repeat;
	}
	</style>
</head>
<?php
	//include config.php file
    require_once('config.php');
	
	$message = "";
	$username = "";
	$admin = "";
	//if submit is clicked
	if(isset($_POST['Submit'])){
		$username = ($_POST['username']);
		$password = ($_POST['password']);
		//query admin table
		$table = "users";
		
		if (isset($_POST['admin'])){
			$table = "admin";			
		}
		
		$stmt = $conn->prepare("SELECT * FROM ".$table." where UserName = ? and Password = ? and Status = 1");
		$stmt->bind_param("ss", $username, $password);		
		
		//execute the SQL query and return records
		$stmt->execute();
		$resultrs = $stmt->get_result();
		if($row=mysqli_fetch_assoc($resultrs)){
			//Login Successful, save to session
			session_regenerate_id();
			
			
			$_SESSION['ID'] = $row['ID'];		
			
			if (isset($_POST['admin'])){
				$_SESSION['USER_TYPE'] = "admin";		
			}else{
				$_SESSION['USER_TYPE'] = "user";		
			}
		
			//echo $row['ID'];
			
			session_write_close();
			
			if (isset($_POST['admin'])){
				//go to users page			
				header("location: users.php");
			}else{
				//go to profile page			
				header("location: profile.php");	
			}
			
			exit();			
		}else{
			//notify invalid account
			$message  = "Invalid username or password!";
		}
	}	
?>

<body class="login-body">

    <div class="container">

		<form class="form-signin" action="index.php" method="post">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
			<div class="error"><?php echo $message?></div>
            <input type="text" name="username" class="form-control" placeholder="User ID" autofocus>
            <input type="password" name="password" class="form-control" placeholder="Password">
            <label class="checkbox">
				<input type="checkbox" name="admin" id="admin" value="admin"> Log in as administrator
            </label>
            <button class="btn btn-lg btn-login btn-block" id="Submit" name="Submit" value="LOGIN" type="submit">Sign in</button>
            <div class="registration">
                Want to join us?
                <a class="pull-right" href="">
                    Email us
                </a>
            </div>
        </div>
      </form>
	  
    </div>
	<script src="js/jquery.js" />
	<script src="js/bootstrap.min.js" />
  </body>
</html>