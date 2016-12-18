<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-8 col-md-offset-2" style="margin-top: 30px;">
	<?php echo form_open_multipart(site_url("master/insertroom"), array('class' => 'form-horiontal', 'id' => 'add_room')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="name" class="col-sm-2 control-label">Room Name</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="name" value="" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="facilities" class="col-sm-2 control-label">Facilities</label>
		    	<div class="col-sm-10">
		      		<textarea name="facilities" class="form-control" id="" cols="3" rows="2"></textarea>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="description" class="col-sm-2 control-label">Description</label>
		    	<div class="col-sm-10">
		      		<textarea name="description" class="form-control" id="" cols="3" rows="4"></textarea>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="image" class="col-sm-2 control-label">Image</label>
		    	<div class="col-sm-10">
		      		<input type="file" name="image" id="id-input-file-3">
		    	</div>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<a href="<?php echo site_url('master') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>