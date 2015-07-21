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
			$message  = "Sorry login Failed! Please check the user name and password.";
		}
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
			<center><div style="color:red;"><?php echo $message?></div></center>
            	<form  method="post" action="index.php">
				<table cellpadding="20">
                	<tr>
                    	<td>
                        	<label for="username">
                            	User Name:
                            </label>
                        </td>
                        
                        <td>
                        	<input type="text" value="<?php echo $username;?>" placeholder="ENTER YOUR USER NAME" id="username" name="username" required="required" />
                        </td>
                    </tr>
					
                	<tr>
                    	<td>
                        	<label for="password">
                            	Password :
                            </label>
                        </td>                        
                        <td>
                        	<input type="password" value="" placeholder="ENTER YOUR PASSWORD" id="password" name="password" required="required" />
                        </td>
                    </tr>
					
					<tr>
                    	<td>
                        </td>                        
                        <td>
                        	<input type="checkbox" name="admin" id="admin" value="admin"/>Log in as administrator?
                        </td>					
					</tr>
					
                	<tr>                        
                        <td>
                        </td>                        
                        <td>
                        	<input type="submit" id="Submit" name="Submit" value="LOGIN" class="submitBtn" />
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