						
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<small class="bigger-30">
							Copyright &copy; <?php echo date('Y') ?>
							<span class="blue bolder">Teitra Mega</span> All Rights reserved
						</small>
					</div>
				</div>
			</div>

			<a href="#" class="go-top btn btn-white btn-round"><i class="fa fa-hand-o-up"></i> Back To Top</a>
		</div><!-- /.main-container -->

<div class="modal fade" id="log-off-modal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title">Do you exit the application ?</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">No</button>
				<a href="<?php echo site_url('login/signout?from_url=' . current_url()); ?>" class="btn btn-sm btn-danger">Yes</a>
			</div>
		</div>
	</div>
</div>


		<!--[if IE]>
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/js/jquery.mobile.custom.min.js'); ?>'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
		<!-- ace scripts -->
		<script src="<?php echo base_url('assets/js/ace-elements.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/ace.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.gritter.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery-ui.custom.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.ui.touch-punch.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.tableCheckbox.js'); ?>"></script>
		<script src="<?php echo base_url('assets/validation/js/formValidation.js') ?>"></script>
		<script src="<?php echo base_url('assets/validation/js/framework/bootstrap.js') ?>"></script><!-- 
		<script src="<?php echo base_url('assets/validation/js/language/id_ID.js') ?>"></script> -->
		<script src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/morris/morris.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/morris/raphael-min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/daterangepicker.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap-timepicker.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/livestamp.min.js'); ?>"></script>
		<script data-pace-options='{ "elements": { "selectors": ["body"] }, "startOnPageLoad": true, "ajax": true }' src="<?php echo base_url('assets/js/pace.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/pass-strength/src/i18n.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/pass-strength/dist/pwstrength-bootstrap.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/pass-strength/pwstrength.js'); ?>"></script>
    	<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/ajaxFileUpload.js'); ?>"></script> -->
		<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.dataTables.bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/dataTables.buttons.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/dataTables.select.min.js'); ?>"></script>
    	<script src="<?php echo base_url('assets/js/holder.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.easypiechart.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.sparkline.index.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.flot.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.flot.pie.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.flot.resize.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/app/backend.js'); ?>"></script>
		<script type="text/javascript"> 
			var base_url 	= '<?php echo site_url(); ?>';
			var base_path 	= '<?php echo base_url(); ?>';
			var current_url = '<?php echo current_url(); ?>';
		</script>
<?php 

/**
 * Load js from loader core
 *
 * @return CI_OUTPUT
 **/
if(isset($js) ==! FALSE) : foreach($js as $file) :  ?>
		<script src="<?php echo $file; ?>"></script>
<?php endforeach; endif; ?>
	</body>
</html>
