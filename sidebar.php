<aside>
  <div id="sidebar"  class="nav-collapse ">
	  <!-- sidebar menu start-->
	  <ul class="sidebar-menu" id="nav-accordion">
		  <?php
			 if (isset($_SESSION["USER_TYPE"]) && $_SESSION["USER_TYPE"] == "admin"){ ?>	    
				<li>
					  <a href="users.php">
						  <i class="fa fa-dashboard"></i>
						  <span>Dashboard</span>
					  </a>
				  </li>
				  <li class="sub-menu">
                      <a href="" class="">
                          <i class="fa fa-cogs"></i>
                          <span>Download</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="android.php">Android Platform</a></li>
                          <li><a  href="ios.php">Ios Platform</a></li>
                      </ul>
                  </li>     
			<?php
			}else{ ?>
				<li class="sub-menu">
					  <a href="index.php">
						  <i class="fa fa-laptop"></i>
						  <span>Login</span>
					  </a>
				  </li>   	
				<?php	
			}
			 
			if (isset($_SESSION["ID"])){ ?>
				<li class="sub-menu">
					  <a href="logout.php">
						  <i class="fa fa-laptop"></i>
						  <span>Log out</span>
					  </a>
				  </li>
				<?php
			}else{?>
				<li class="sub-menu">
					  <a href="register.php">
						  <i class="fa fa-book"></i>
						  <span>User Registration</span>
					  </a>
				  </li>
			<?php
			}
		  ?>
	  </ul>
	  <!-- sidebar menu end-->
  </div>
</aside>