<ul>  
  <?php
     if (isset($_SESSION["USER_TYPE"]) && $_SESSION["USER_TYPE"] == "admin"){ ?>	    
		<li><a href="users.php">Users</a></li>
	    <li><a href="search.php">Search</a></li>        
	<?php
    }else{ ?>
		<li><a href="index.php">Login</a></li>		
		<?php	
	}
	 
	if (isset($_SESSION["ID"])){ ?>
		<li><a href="logout.php">Log out</a></li>  
		<?php
	}else{?>
		<li><a href="register.php">User Registration</a></li>
	<?php
	}
  ?>
</ul>