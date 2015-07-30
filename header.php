<header class="header white-bg">
	<div class="sidebar-toggle-box">
		<div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
	</div>
	<!--logo start-->
	<a href="users.php" class="logo">Location<span>Tracker</span></a>
	<!--logo end-->

	<div class="top-nav ">
		<ul class="nav pull-right top-menu">
		<?php
			if (isset($_SESSION["ID"])){ ?> 
				<li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>
				<?php
			}  
		   ?>
	  </ul>
	</div>
</header>