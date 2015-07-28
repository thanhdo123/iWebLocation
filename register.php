<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Register</title>
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
	<section id="container">
		<!--header start-->
		<?php include "header.php"; ?>
		<!--header end-->
		<!--sidebar start-->
		<?php include "sidebar.php"; ?>
		<!--sidebar end-->
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<!-- page start-->
				<div class="row">
					<div class="col-md-12">
						<section class="panel">
							<header class="panel-heading"> Registration </header>
							<div class="panel-body">
								<?php
									if ($error_message != ''){ ?>
									<div class="alert alert-warning">
										<a href="#" class="close" data-dismiss="alert">&times;</a>
										<strong>Error!</strong> <?php echo $error_message; ?>
									</div>
								<?php
									}  
								   ?>
								<form name="newMebReg" method="post" action="register.php">
									<div class="row">
										<div class="col-lg-10">
											<div class="form-group">
												<label class="col-lg-2 col-sm-2 control-label">First Name</label>
												<div class="col-lg-9">
													<div class="iconic-input">
														<i class="fa fa-bullhorn"></i> 
															<input type="text"
																class="form-control" name="firstname"
																value="<?php echo $firstname; ?>"
																placeholder="First Name"
																required>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-10" style="margin-top:10px">
											<div class="form-group">
												<label class="col-lg-2 col-sm-2 control-label">Last Name</label>
												<div class="col-lg-9">
													<div class="iconic-input">
														<i class="fa fa-bullhorn"></i> 
															<input type="text"
																class="form-control" name="lastname"
																value="<?php echo $lastname; ?>"
																placeholder="Last Name"
																required>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-10" style="margin-top:10px">
											<div class="form-group">
												<label class="col-lg-2 col-sm-2 control-label">User Name</label>
												<div class="col-lg-9">
													<div class="iconic-input">
														<i class="fa fa-bullhorn"></i> 
															<input type="text"
																class="form-control" name="username"
																value="<?php echo $username; ?>"
																placeholder="User Name"
																required>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-10" style="margin-top:10px">
											<div class="form-group">
												<label class="col-lg-2 col-sm-2 control-label">Phone Number</label>
												<div class="col-lg-9">
													<div class="iconic-input">
														<i class="fa fa-bullhorn"></i> 
															<input type="text"
																class="form-control" name="phonenumber"
																value="<?php echo $phonenumber; ?>"
																placeholder="Phone Number"
																required>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-10" style="margin-top:10px">
											<div class="form-group">
												<label class="col-lg-2 col-sm-2 control-label">Password</label>
												<div class="col-lg-9">
													<div class="iconic-input">
														<i class="fa fa-bullhorn"></i> 
															<input type="password"
																class="form-control" name="password"
																placeholder="Password"
																required>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-10" style="margin-top:10px">
											<div class="form-group">
												<label class="col-lg-2 col-sm-2 control-label">Confirm Password</label>
												<div class="col-lg-9">
													<div class="iconic-input">
														<i class="fa fa-bullhorn"></i> 
															<input type="password"
																class="form-control" name="cpassword"
																placeholder="Confirm Password"
																required>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-10" style="margin-top:10px">
											<div class="form-group">
												<label class="col-lg-2 col-sm-2 control-label">Mobile OS</label>
												<div class="col-lg-9">
													<div class="iconic-input">
														<i class="fa fa-bullhorn"></i> 
														<select name="mobileos" class="form-control" required>
														  <option value="">Mobile OS</option>
														  <option value="Android" <?php echo (($mobileos == 'Android')?"selected='selected'":"")?>>Android</option>
														  <option value="IPhone" <?php echo (($mobileos == 'IPhone')?"selected='selected'":"")?>>IPhone</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row" style="margin-top:10px">
										<button class="btn btn-success" type="submit" name="submit_reg" id="Submit">
											<span class="glyphicon glyphicon-user"></span>Submit
										</button>
										<button class="btn btn-success" type="reset">
											<span class="glyphicon glyphicon-user"></span>Reset
										</button>
									</div>
								</form>
							</div>
						</section>
					</div>
				</div>
				<!-- page end-->
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
<? ob_flush(); ?>