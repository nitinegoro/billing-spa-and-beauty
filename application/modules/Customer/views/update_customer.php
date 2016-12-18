<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-8 col-md-offset-2" style="margin-top: 30px;">
	<?php echo form_open(site_url("customer/update/{$get->customer_ID}"), array('class' => 'form-horiontal', 'id' => 'update_customer')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="name" class="col-sm-2 control-label">Name</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="name" value="<?php echo $get->name; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="gender" class="col-sm-2 control-label">Gender</label>
		    	<div class="col-sm-6">
		      		<select name="gender" class="form-control" required="">
		      			<option value="">-- SELECT --</option>
		      			<option value="male" <?php echo ($get->gender=='male') ? 'selected' : ''; ?>>Male</option>
		      			<option value="female" <?php echo ($get->gender=='female') ? 'selected' : ''; ?>>Female</option>
		      		</select>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="births" class="col-sm-2 control-label">Birts</label>
		    	<div class="col-sm-4">
					<div class="input-group bootstrap-timepicker">
						<input name="births" type="text" class="form-control date-picker" placeholder="Ex : <?php echo date('Y-m-d') ?>" value="<?php echo $get->births; ?>" />
						<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
						</span>
					</div>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="phone_number" class="col-sm-2 control-label">Phone Number</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="phone_number" value="<?php echo $get->phone_number; ?>">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="email" class="col-sm-2 control-label">E-Mail</label>
		    	<div class="col-sm-10">
		      		<input type="email" class="form-control" name="email" value="<?php echo $get->email; ?>">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="job" class="col-sm-2 control-label">Jobs</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="job" value="<?php echo $get->job; ?>">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="address" class="col-sm-2 control-label">Address</label>
		    	<div class="col-sm-10">
		      		<textarea name="address" class="form-control" id="" cols="3" rows="4"><?php echo $get->address; ?></textarea>
		    	</div>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<a href="<?php echo site_url('customer') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>