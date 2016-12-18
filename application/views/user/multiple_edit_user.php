<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Update Users</h4><hr>
			</div>
<?php 
echo form_open(site_url("user/bulkuser"), array('class' => 'form-horiontal', 'id' => 'create_user')); 
if(is_array($this->input->post('users'))) :
	foreach($this->input->post('users') as $key => $value) :
		$get = $this->user->get($value);
		echo form_hidden('users[]', $get->user_id);
?>
		  	<div class="form-group col-md-12">
		    	<label for="full_name[]" class="col-sm-2 control-label">Full Name</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="full_name[]" value="<?php echo $get->full_name; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="email" class="col-sm-2 control-label">E-mail</label>
		    	<div class="col-sm-10">
		      		<input type="email" class="form-control" name="email[]" value="<?php echo $get->user_email; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="phone" class="col-sm-2 control-label">Phone</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="phone[]" value="<?php echo $get->user_phone; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="access" class="col-sm-2 control-label">User Privileges</label>
		    	<div class="col-sm-10">
	<?php 
	/**
	 * Role acces data (result_array)
	 *
	 **/
	echo form_dropdown('role[]', array_column($role_access, 'role_name', 'role_id'), $get->role_id, array('class' => 'form-control'));
	?>
		    	</div>
		  	</div>		  	<div class="col-md-12"><hr></div>
	<?php  
	endforeach;
	?>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit" name="action" value="update">
							<i class="ace-icon fa fa-check bigger-110"></i>Updates
						</button>
						<a href="<?php echo site_url('user') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</a>
					</div>
				</div>
			  </div>
<?php 
else :
	$this->template->alert(
		' Empty changes.', 
		array('type' => 'warning','icon' => 'info')
	);
	redirect('user');
endif;
echo form_close(); 
?>
		</div>
	</div>

</div>