<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-4">
			<a href="<?php echo site_url('user/addrole') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round">
				<i class="ace-icon fa fa-plus gray"></i> Add New Record
			</a>
			<div class="space-4"></div>
		</div>
<?php echo form_open(site_url('user/bulkuser')); ?>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Name Privileges</th>
					<th>Description</th>
					<th width="100">Actions</th>
				</tr>
			</thead>
			<tbody>
<?php  
/* Start Loop Users All */
foreach($role_access as $row) :
?>
				<tr>
					<td><?php echo $row->role_name; ?></td>
					<td><?php echo $row->description; ?></td>
					<td class="text-center">
						<div class="action-buttons">
							<a class="green" href="<?php echo site_url("user/getrole/{$row->role_id}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Update">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
				<?php  
				if($row->role_id > 2) :
				?>
							<a class="red open-role-delete" data-id="<?php echo $row->role_id; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
								<i class="ace-icon fa fa-trash-o bigger-130"></i>
							</a>
				<?php  
				endif;
				?>
						</div>
					</td>
				</tr>
<?php  
/* End Loops */
endforeach;
?>
			</tbody>
		</table>

	</div>
</div>

<div class="modal" id="modal-delete-role">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Privileges.</h5>
			</div>
			<div class="modal-body">
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Are you sure you want to delete this Privileges?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</a>
				<a id="button-delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Yes</a>
			</div>
		</div>
	</div>
</div>