<!-- sidebar: style can be found in sidebar.less -->
	<div class="sidebar">
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?php echo WEB_ROOT; ?>views/?v=DB" class="nav-link"><i class="nav-icon fas fa-calendar"></i><p>Events Calendar</p></a>
				</li>
				<li class="nav-item">
					<a href="<?php echo WEB_ROOT; ?>views/?v=LIST" class="nav-link"><i class="nav-icon fas fa-newspaper-o"></i><p>Event Booking</p></a>
				</li>
				<li class="nav-item">
					<a href="<?php echo WEB_ROOT; ?>views/?v=USERS" class="nav-link"><i class="nav-icon fas fa-users"></i><p>User Details</p></a>
				</li>
				<?php
				$type = $_SESSION['calendar_fd_user']['type'];
				if($type == 'admin') {
				?>
				<li class="nav-item">
					<a href="<?php echo WEB_ROOT; ?>views/?v=HOLY" class="nav-link"><i class="nav-icon fas fa-plane"></i><p>Holidays</p></a>
				</li>
				<?php
				}
				?>
			</ul>
		</nav>
	</div>
  <!-- /.sidebar -->