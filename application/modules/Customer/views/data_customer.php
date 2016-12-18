<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-2">
			<label>Show </label>
			<select name="per_page" id="input" class="select-page" onchange="window.location = '<?php echo site_url('customer?per_page='); ?>' + this.value + '&q=<?php echo $this->input->get('q'); ?>';">
				<option value="10" <?php echo (!$this->input->get('per_page')) ? 'selected' : ''; ?>>10</option>
	<?php  
	$start = 20;
		while($start <= 100) :
	?>
			<option value="<?php echo $start; ?>" <?php echo ($this->input->get('per_page')==$start) ? 'selected' : ''; ?>><?php echo $start; ?></option>
	<?php  
	$start += 10;
	endwhile;
	?>
			</select>
			<label> per page </label>
			<div class="space-4"></div>
		</div>
		<div class="col-md-4">
	<?php
	if($this->app->role(3,'create')) :
	?>
			<a href="<?php echo site_url('customer/add') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round">
				<i class="ace-icon fa fa-plus gray"></i> Add New Record
			</a>
	<?php  
	endif;
	?>
			<div class="space-4"></div>
		</div>
		<div class="col-md-3 pull-right">
	<?php echo form_open(site_url("customer"), array('method' => 'get')); ?>
			<div class="input-group">
				<input class="form-control input-sm" name="q" type="text" placeholder="Search..." value="<?php echo $this->input->get('q') ?>" />
				<span class="input-group-addon" type="button">
					<i class="ace-icon fa fa-search"></i>
				</span>
			</div>
	<?php echo form_close(); ?>
			<div class="space-4"></div>
		</div>
<?php echo form_open(site_url('customer/bulkaction')); ?>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="30">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th>
					<th width="250">Name</th>
					<th>Gender</th>
					<th>Births</th>
					<th>Phone Number</th>
					<th>E-Mail</th>
					<th>Jobs</th>
					<th>Address</th>
					<th width="100">Actions</th>
				</tr>
			</thead>
			<tbody>
<?php  
// Start Loop Customers
foreach($customers as $row) :
	$date = new DateTime($row->births);
?>
				<tr>
					<td>
						<label class="pos-rel">
							<input type="checkbox" class="ace" name="customers[]" value="<?php echo $row->customer_ID; ?>" /> <span class="lbl"></span>
						</label>
					</td>
					<td><?php echo $row->name; ?></td>
					<td><?php echo ucfirst($row->gender) ?></td>
					<td><?php echo ($row->births !='0000-00-00') ? $date->format('d/m/Y') : '-' ?></td>
					<td><?php echo $row->phone_number; ?></td>
					<td><?php echo $row->email; ?></td>
					<td><?php echo $row->job; ?></td>
					<td><?php echo $row->address; ?></td>
					<td class="text-center">
						<div class="hidden-sm hidden-xs action-buttons">
	<?php
	if($this->app->role(3,'update')) :
	?>
							<a class="green" href="<?php echo site_url("customer/get/{$row->customer_ID}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Update">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
	<?php  
	endif;
	if($this->app->role(3,'delete')) :
	?>
							<a class="red open-customer-delete" data-id="<?php echo $row->customer_ID; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
								<i class="ace-icon fa fa-trash-o bigger-130"></i>
							</a>
	<?php  
	endif;
	?>
						</div>
					</td>
				</tr>
<?php  
endforeach;
?>
			</tbody>
			<thead>
			<tr>
				<th>
					<label class="pos-rel">
						<input type="checkbox" class="ace" /> <span class="lbl"></span>
					</label>
				</th>
				<th colspan="6">
					<small style="padding-right:20px;">With selected :</small>
	<?php  
	if($this->app->role(3,'delete')) :
	?>
					<a class="btn btn-minier btn-white btn-round btn-danger customer-delete-multiple" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
						<i class="ace-icon fa fa-trash-o"></i> <small> Delete</small>
					</a>
	<?php  
	endif;
	?>
				</th>
				<th colspan="2">Showing <?php echo count($customers)."\nfrom\n".$total_rows; ?> records.</th>
			</tr>
			</thead>
		</table>
		<div class="modal" id="modal-delete-multiple">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header bg-delete">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Customer</h5>
					</div>
			<div class="modal-body">
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Are you sure ?
				</p>
			</div>
					<div class="modal-footer text-center">
						<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</a>
						<button name="action" value="delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Yes</button>
					</div>
				</div>
			</div>
		</div>
<?php echo form_close(); ?>
		<div class="col-md-12 text-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>

<div class="modal" id="modal-delete">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Customer</h5>
			</div>
			<div class="modal-body">
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Are you sure ?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</a>
				<a id="button-delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Yes</a>
			</div>
		</div>
	</div>
</div>