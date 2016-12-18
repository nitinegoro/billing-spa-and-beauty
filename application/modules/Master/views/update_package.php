<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-8 col-md-offset-2" style="margin-top: 30px;">
	<?php echo form_open(site_url("master/updatepackage/{$get->package_ID}"), array('class' => 'form-horiontal', 'id' => 'add_package')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="room" class="col-sm-2 control-label">Room</label>
		    	<div class="col-sm-10">
		      		<select name="room" id="inputRoom" class="form-control" required="required">
		      			<option value="">-- SELECT --</option>
		<?php  
		foreach($rooms as $row) :
		?>
		      			<option value="<?php echo $row->ID_room; ?>" <?php echo ($get->package_room==$row->ID_room) ? 'selected' : ''; ?>><?php echo $row->room_name; ?></option>
		<?php  
		endforeach;
		?>
		      		</select>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="name" class="col-sm-2 control-label">Name</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="name" value="<?php echo $get->package_name; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="duration" class="col-sm-2 control-label">Duration</label>
		    	<div class="col-sm-4">
					<div class="input-group bootstrap-timepicker">
						<input name="duration" id="timepicker1" value="<?php echo $get->duration; ?>" type="text" class="form-control" placeholder="Ex : 01:30:00" required="" />
						<span class="input-group-addon">
							<i class="fa fa-clock-o bigger-110"></i>
						</span>
					</div>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="price" class="col-sm-2 control-label">Price</label>
		    	<div class="col-sm-10">
		      		<input type="text" name="price" id="input" class="form-control" value="<?php echo $get->price; ?>" placeholder="Ex : 100000" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="description" class="col-sm-2 control-label">Description</label>
		    	<div class="col-sm-10">
		      		<textarea name="description" class="form-control" id="" cols="3" rows="4"><?php echo $get->package_description; ?></textarea>
		    	</div>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<a href="<?php echo site_url('master/package') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>