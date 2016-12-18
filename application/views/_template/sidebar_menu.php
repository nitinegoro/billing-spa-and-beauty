<body class="no-skin">
		<div id="load-progress"></div>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state sidebar-fixed">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">
<?php
// only superadmin feature  
if($this->session->userdata('user')->user_id == 1) :
?>
					<li class="<?php echo active_link_controller('main'); ?> hover">
						<a href="<?php echo site_url('main') ?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard</span>
						</a>

						<b class="arrow"></b>
					</li>
<?php  
endif;
if($this->app->role(0,'menu')) :
?>
					<li class="<?php echo active_link_controller('transaction'); ?> hover">
						<a href="<?php echo site_url('transaction') ?>">
							<i class="menu-icon fa fa-exchange"></i>
							<span class="menu-text"> Transaction </span>
						</a>
						<b class="arrow"></b>
					</li>
<?php  
endif;
if($this->app->role(1,'menu')) :
?>

					<li class="<?php echo active_link_controller('master'); ?> hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-database"></i>
							<span class="menu-text"> Master </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
	<?php
	if($this->app->role(1,'menu')) :
	?>
							<li class="hover <?php echo active_link_method('index','master'); ?> ">
								<a href="<?php echo site_url('master') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Rooms Management
								</a>
								<b class="arrow"></b>
							</li>
	<?php  
	endif;
	if($this->app->role(2,'menu')) :
	?>
							<li class="hover <?php echo active_link_method('package', 'master'); ?>">
								<a href="<?php echo site_url('master/package') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Service Package
								</a>
								<b class="arrow"></b>
							</li>
	<?php 
	endif; 
	?>
						</ul>
					</li>
<?php  
endif;
if($this->app->role(3,'menu')) :
?>
					<li class="<?php echo active_link_controller('customer'); ?> hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Customers </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="hover <?php echo active_link_method('index','customer') ?>">
								<a href="<?php echo site_url('customer') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									All Customers
								</a>
								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('add','customer') ?>">
								<a href="<?php echo site_url('customer/add') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Customer
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<?php  
endif;
if($this->app->role(4,'menu')) :
?>
					<li class="<?php echo active_link_controller('report'); ?> hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bar-chart"></i>
							<span class="menu-text"> Report </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="hover <?php echo active_link_method('index','report') ?>">
								<a href="<?php echo site_url('report') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Transactions
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<?php
endif;
// only superadmin feature  
if($this->session->userdata('user')->user_id == 1) :
?>
					<li class="hover <?php echo active_link_controller('user').active_link_controller('setting') ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-wrench"></i>
							<span class="menu-text"> Settings </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="hover <?php echo active_link_method('index', 'user'); ?>">
								<a href="<?php echo site_url('user') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									All User
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('adduser'); ?>">
								<a href="<?php echo site_url('user/adduser') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Add User
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('role'); ?>">
								<a href="<?php echo site_url('user/role') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									User Privileges
								</a>
								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('index', 'setting'); ?>">
								<a href="<?php echo site_url('setting') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Application Setting
								</a>
								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('account','user'); ?>">
								<a href="<?php echo site_url('user/account') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Login Setting
								</a>
								<b class="arrow"></b>
							</li>

						</ul>
					</li>
<?php  
 else :	
?>
					<li class="hover <?php echo active_link_method('account','user'); ?>">
						<a href="<?php echo site_url('user/account') ?>">
							<i class="menu-icon fa fa-key"></i>
							Login Setting
						</a>
						<b class="arrow"></b>
					</li>
<?php  
endif;
?>
					<li class="hover">
						<a href="#" data-toggle="modal" data-target="#log-off-modal">
							<i class="menu-icon fa fa-power-off"></i>
							<span class="menu-text"> Sign Out </span>
						</a>
						<b class="arrow"></b>
					</li>

				</ul><!-- /.nav-list -->
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container" style="margin-top: 50px;">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

<div class="page-header">
<?php  
/**
 * Generated Page Title
 *
 * @return string
 **/
	echo $page_title;
?>
<?php 
/**
 * Generate Breadcrumbs from library
 *
 * @var string
 **/
	if(isset($breadcrumb) != FALSE)
		echo $breadcrumb; 
?>
</div><!-- /.page-header -->
				

