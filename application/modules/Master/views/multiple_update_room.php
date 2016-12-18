<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-8 col-md-offset-2" style="margin-top: 30px;">
<?php 
echo form_open(site_url("master/bulkroom"), array('class' => 'form-horiontal', 'id' => 'add_room')); 
if(is_array($this->input->post('rooms'))) :
	foreach($this->input->post('rooms') as $key => $value) :
		$get = $this->room->get($value);
	echo form_hidden('room-id[]', $get->ID_room);
?>
		  	<div class="form-group col-md-12">
		    	<label for="name[]" class="col-sm-2 control-label">Room Name</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="name[]" value="<?php echo $get->room_name; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="facilities[]" class="col-sm-2 control-label">Facilities</label>
		    	<div class="col-sm-10">
		      		<textarea name="facilities[]" class="form-control" id="" cols="3" rows="2"><?php echo $get->facilities; ?></textarea>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="description[]" class="col-sm-2 control-label">Description</label>
		    	<div class="col-sm-10">
		      		<textarea name="description[]" class="form-control" id="" cols="3" rows="4"><?php echo $get->room_description ?></textarea>
		    	</div>
		  	</div>
			<div class="col-md-12"><hr></div>
<?php
	endforeach;
else :
	$this->template->alert(
		' Empty selected.', 
		array('type' => 'danger','icon' => 'times')
	);
redirect('master');
endif; 
?>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit" name="action" value="update">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<button type="reset" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</button>
					</div>
				</div>
			  </div>
<?php
echo form_close(); 

?>
		</div>
	</div>

</div>

