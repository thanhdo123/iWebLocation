<aside>
  <div id="sidebar"  class="nav-collapse ">
	  <!-- sidebar menu start-->
	  <ul class="sidebar-menu" id="nav-accordion">
		  <?php
			 if (isset($_SESSION["USER_TYPE"]) && $_SESSION["USER_TYPE"] == "admin"){ ?>	    
				<li>
					  <a href="user.php">
						  <i class="fa fa-dashboard"></i>
						  <span>Dashboard</span>
					  </a>
				  </li>
				  <li class="sub-menu">
					  <a href="Search.php">
						  <i class="fa fa-dashboard"></i>
						  <span>Search</span>
					  </a>
				  </li>       
			<?php
			}else{ ?>
				<li class="sub-menu">
					  <a href="index.php">
						  <i class="fa fa-dashboard"></i>
						  <span>Login</span>
					  </a>
				  </li>   	
				<?php	
			}
			 
			if (isset($_SESSION["ID"])){ ?>
				<li class="sub-menu">
					  <a href="logout.php">
						  <i class="fa fa-dashboard"></i>
						  <span>Log out</span>
					  </a>
				  </li>
				<?php
			}else{?>
				<li class="sub-menu">
					  <a href="register.php">
						  <i class="fa fa-dashboard"></i>
						  <span>User Registration</span>
					  </a>
				  </li>
				<li><a href="register.php">User Registration</a></li>
			<?php
			}
		  ?>
	  </ul>
	  <!-- sidebar menu end-->
  </div>
</aside>