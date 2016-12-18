<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Login Setting</h4><hr>
			</div>
	<?php echo form_open(site_url("user/account_setting"), array('class' => 'form-horiontal', 'id' => 'account_setting')); 
		$get = $this->user->get( $this->session->userdata('user')->user_id);
	?>
		  	<div class="form-group col-md-12">
		    	<label for="username" class="col-sm-3 control-label">Username <strong class="text-danger">*</strong></label>
		    	<div class="col-sm-9">
		      		<input type="text" class="form-control" name="username" value="<?php echo $get->username; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="password" class="col-sm-3 control-label">New Password</label>
		    	<div class="col-sm-9">
		      		<input type="password" class="form-control" name="password" id="password" value="">
		      		<p class="help-block"><i>Enter a new password If you want to change your password.</i></p>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="pass_again" class="col-sm-3 control-label">Repeat Password</label>
		    	<div class="col-sm-9">
		      		<input type="password" class="form-control" name="pass_again" value="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="old_pass" class="col-sm-3 control-label">Old Password <strong class="text-danger">*</strong></label>
		    	<div class="col-sm-9">
		      		<input type="password" class="form-control" name="old_pass" value="" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		  		<hr>
		    	<strong class="text-danger">*</strong> : <i>Required field!</i>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<a href="<?php echo site_url('user') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back to users
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>