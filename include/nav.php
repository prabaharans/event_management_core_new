<!-- Navbar -->
  	<!-- Left navbar links -->
  	<ul class="navbar-nav">
	  	<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>
  	<ul class="navbar-nav ml-auto">

		<li class="nav-item d-none d-sm-inline-block">
			<a class="nav-link">
			<span class="hidden-xs"></i>Welcome, <?php echo strtoupper($_SESSION['calendar_fd_user']['name']); ?></span>
			</a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
		<a class="nav-link" href="<?php echo WEB_ROOT; ?>?logout" title="Log Out">
		<i class="nav-icon fas fa-sign-out col-2" aria-hidden="true"></i>
		<span class="hidden-xs">Log Out</span>
		</a>
		</li>
	</ul>
<!-- /.navbar -->