<!DOCTYPE html>
<html lang="id">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login - <?php echo $this->app->get('app_title'); ?></title>
		<meta name="description" content="Sistem Informasi Perpustakaan STIE Pertiba Pangkalpinang." />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/logo_kop.png'); ?>"/>
		<!-- bootstrap & fontawesome & animate -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/4.2.0/css/font-awesome.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>" />
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url('assets/fonts/fonts.googleapis.com.css'); ?>" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace.min.css'); ?>" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-rtl.min.css'); ?>" />
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<style>
			.text-red { color: red; }
			.pd-top { padding-top: 100px; }
			.login-layout { 
			  background: url(<?php echo base_url('assets/img/backaground.jpg'); ?>) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			}
		</style>
		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout blur-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container pd-top">
							<div class="space-6"></div>

							<div class="space-6"></div>
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border  animated <?php echo ($this->session->flashdata('alert')) ? 'shake' : ''; ?>">
									<div class="widget-body">
										<div class="widget-main">
											<?php echo $this->session->flashdata('alert'); ?>
											<div class="space-6"></div>
											<form action="<?php echo site_url('login?from_url='.$this->input->get('from_url')); ?>" method="post">
												<fieldset>
													<label for="username">Username :</label>
													<label class="block clearfix has-feedback" for="username">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>" />
															<i class="ace-icon fa fa-user"></i>
															<?php echo form_error('username', '<small class="text-red">', '</small>'); ?>
														</span>
													</label>
													<label for="password">Password :</label>
													<label class="block clearfix" for="password">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" id="login-password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
														<?php echo form_error('password', '<small class="text-red">', '</small>'); ?>
													</label>
 														<label class="inline">
															<input type="checkbox" class="ace" onclick="showPassword()" />
															<span class="lbl"> Show Password</span>
														</label>
													<div class="space"></div>

													<div class="clearfix">
														<button type="submit" class="btn-block pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->
	
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
							</div><!-- /.position-relative -->
							<div class="space-6"></div>
							<div class="col-md-12 text-center">
								<img src="<?php echo base_url('assets/img/teitra.png'); ?>" class="img-responsive" alt="">
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url('assets/js/jquery.2.1.1.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url('assets/js/jquery.min.js'); ?>'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js'); ?>'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			
			function showPassword() {
			    var key_attr = $('#login-password').attr('type');
			    if(key_attr != 'text') {
					$('.checkbox').addClass('show');
					$('#login-password').attr('type', 'text');
			    } else {
					$('.checkbox').removeClass('show');
					$('#login-password').attr('type', 'password');
			    }
			}
			
		</script>
	</body>
</html>
