<!DOCTYPE html>
<html lang="id">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo (isset($title)) ? $title : "Unknow Title"; ?> - <?php echo $this->app->get('app_title'); ?></title>
		<meta name="description" content="Sistem Informasi Inventaris STIE Pertiba Pangkkalpinang" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/'); ?>"/>
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css'); ?>" />
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/fonts.googleapis.com.css'); ?>" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace.min.css'); ?>" class="ace-main-stylesheet" id="main-ace-style" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-part2.min.css'); ?>" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.custom.min.css') ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.gritter.min.css') ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-skins.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ace-rtl.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/validation/css/formValidation.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-timepicker.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/daterangepicker.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/pace.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/morris/morris.css'); ?>" />
		<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
		<style>
			ul .submenu .active { font-weight: bold; }
			.mini-font { font-size: 12px; }
			.pointer { cursor: pointer; }
			.go-top { position: fixed; bottom: 6em; right: 1em; text-decoration: none; color: white; background-color: rgba(0, 0, 0, 0.3); padding: 1em;display: none; }
			.go-top:hover { background-color: rgba(0, 0, 0, 0.6); }
			.bg-delete { background-color: #D15B47; color: white; }
			.bg-terima { background-color: #87B87F; color: white; }
			.bg-pending { background-color:#FFB752; color: white; }
			.bg-update { background-color: #428BCA; color: white; }
			.bg-primary { background-color: #438EB9; color: white; }
			.progress { margin-top: 10px; }
			a  { cursor: pointer; }
			select .select-page {  font-size: 50px; }
			span.tprice { font-size: 15px; font-weight: bold; color: #52BD33; }
			span.gray { color: #ABBAC3 }
			.pointer { cursor: pointer; }
		</style>
<?php 
/**
 * Load css from loader core
 *
 * @return CI_OUTPUT
 **/
if(isset($css) !== FALSE) : foreach($css as $file) : ?>
		<link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" />
<?php endforeach; endif; ?>
		<!-- ace settings handler -->
		<script src="<?php echo base_url('assets/js/ace-extra.min.js'); ?>"></script>
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="<?php echo base_url('assets/js/html5shiv.min.j'); ?>s"></script>
		<script src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
		<![endif]-->
		<!--[if !IE]> -->
		<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js'); ?>"></script>
		<!-- <![endif]-->
		<script src="<?php echo base_url('assets/js/countdown.js') ?>"></script>
		<script src="<?php echo base_url('assets/app/waktu.js') ?>"></script>
	</head>