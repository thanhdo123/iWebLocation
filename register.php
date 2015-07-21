<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>iWebLocation</title>
	<link rel="stylesheet" type="text/css" href="project.css">
</head>
<?php

require_once('config.php');

$error_message = '';

//declaring variables
$firstname = ""; //First Name
$lastname = ""; //Last Name
$username = ""; //username
$pswd = ""; //Password
$pswd2 = ""; // Password 2
$message = "";
$mobileos = "";
$phonenumber = "";
if (isset($_POST['submit_reg'])){
	//registration form
	$firstname = strip_tags(@$_POST['firstname']);
	$lastname = strip_tags(@$_POST['lastname']);
	$username = strip_tags(@$_POST['username']);
	$pswd = strip_tags(@$_POST['password']);
	$pswd2 = strip_tags(@$_POST['cpassword']);	
	$mobileos = strip_tags(@$_POST['mobileos']);	
	$phonenumber = strip_tags(@$_POST['phonenumber']);
	
	if(empty($firstname) || empty($lastname) || empty($username) || empty($pswd) || empty($pswd2) || empty($phonenumber))
	{
		$error_message = 'Please check required fields.';
	}
	elseif ($pswd != $pswd2 )
	{
		$error_message = 'Passwords do not match.';
	}else {
		//check duplicate user name
		$stmt = $conn->prepare("SELECT * FROM users where UserName = ? and Password = ? and Status = 1");
		$stmt->bind_param("ss", $username, $pswd);		
		
		//execute the SQL query and return records
		$stmt->execute();
		$resultrs = $stmt->get_result();
		if($row=mysqli_fetch_assoc($resultrs)){
			$error_message = 'User name is not available.';
		}else{
			$stmt = $conn->prepare("INSERT INTO users (UserName, PhoneNumber, FirstName, LastName, Password, Status, MobileType) values (?,?,?,?,?,1,?)");
			$stmt->bind_param("ssssss", $username, $phonenumber, $firstname, $lastname, $pswd, $mobileos);	
			$stmt->execute();
			
			//go to registerSuccess page			
			header("location: registerSuccess.php");
		}
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
			
			<form name="newMebReg" method="post" action="register.php">
				<table style="width: 700px; border: 0px;" cellspacing="1" cellpadding="1">
				   <tr>
					  <td colspan="2" style="color:red"><?php echo $error_message; ?></td>
					</tr>
					<tr>
					  <td colspan="2"><strong>Registration</strong></td>
					</tr>					
					<tr>
					  <td>First Name</td>
					  <td>
						<input name="firstname" type="text" style="width: 200px;" maxlength="100" value="<?php echo $firstname; ?>"><span style="color:red">*</span></td>
					</tr>	
					<tr>
					  <td>Last Name</td>
					  <td>
						<input name="lastname" type="text" style="width: 200px;" maxlength="100" value="<?php echo $lastname; ?>"><span style="color:red">*</span></td>
					</tr>
					<tr>
					  <td>User Name</td>
					  <td>
						<input name="username" type="text" style="width: 200px;" maxlength="100" value="<?php echo $username; ?>"><span style="color:red">*</span></td>
					</tr>
					<tr>
					  <td>Phone Number</td>
					  <td>
						<input name="phonenumber" type="text" style="width: 200px;" maxlength="100" value="<?php echo $phonenumber; ?>"><span style="color:red">*</span></td>
					</tr>					
					<tr> 
					  <td style="width: 583px">Password</td>&nbsp;&nbsp;
					  <td style="width: 306px"> 
						<input name="password" type="password" style="width: 200px;" maxlength="20"  /><span style="color:red">*</span></td> 
					</tr>
					<tr>
					  <td>Confirm Password</td>
					  <td> 
						<input name="cpassword" type="password" style="width: 200px;" maxlength="20" /><span style="color:red">*</span></td>
					</tr>	
					<tr>
					  <td>Mobile OS</td>
					  <td>
					    <select name="mobileos">
						  <option value="Android" <?php echo (($mobileos == 'Android')?"selected='selected'":"")?>>Android</option>
						  <option value="IPhone" <?php echo (($mobileos == 'IPhone')?"selected='selected'":"")?>>IPhone</option>
						</select>
					  <span style="color:red">*</span></td>
					</tr>	
					<tr>
					 
					  <td colspan="2"><br/>
					  <span style="color:red">*</span> indicates required field</td>
					</tr>
					<tr> 
						<td></td>
					  <td style="width: 583px" class="auto-style2">&nbsp;
					  <input type="submit" name="submit_reg" value="Submit" style="width: 74px" />
					  <input type="reset" name="reset" value="Reset" style="width: 70px" /></td>
					  <br />
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
<? ob_flush(); ?>