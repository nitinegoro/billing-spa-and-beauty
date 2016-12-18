<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Update Privileges</h4><hr>
			</div>
	<?php echo form_open(site_url("user/updaterole/{$get->role_id}"), array('class' => 'form-horiontal')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="name" class="col-sm-2 control-label">Name</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="name" value="<?php echo $get->role_name; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label class="col-sm-2 control-label">Description</label>
		    	<div class="col-sm-10">
		      		<textarea name="description" class="form-control" rows="3"><?php echo $get->description; ?></textarea>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label class="col-sm-2 control-label">Privileges</label>
		    	<div class="col-md-12">
		    		<span class="space-4"></span>
		    		<table class="table table-bordered">
		    			<thead>
		    				<tr>
		    					<th colspan="2" class="text-center">Module Name</th>
		    					<th rowspan="2" width="100" class="text-center">Unlock</th>
		    					<th rowspan="2" width="100" class="text-center">Lock</th>
		    				</tr>
		    				<tr>
		    					<th class="text-center">Menu</th>
		    					<th class="text-center">Sub Menu</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    			<?php echo form_hidden('role[0][module]', 'transaction'); ?>
		    				<tr>
		    					<td rowspan="3">Transaction</td>
		    					<td>Transaction Page</td>
		    					<td class="text-center">
									<label>
										<input name="role[0][menu]" class="ace ace-switch" type="radio" value="1" required <?php echo ($this->user->role($get->role, 0, 'menu')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[0][menu]" class="ace ace-switch" type="radio" value="0" required <?php echo (!$this->user->role($get->role, 0, 'menu')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    				</tr>
		    				<tr>
		    					<td>Update Transaction</td>
		    					<td class="text-center">
									<label>
										<input name="role[0][update]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 0, 'update')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[0][update]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 0, 'update')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>		    				
		    				</tr>
		    				<tr>
		    					<td>Delete Transaction</td>
		    					<td class="text-center">
									<label>
										<input name="role[0][delete]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 0, 'delete')) ? 'checked' : ''; ?>/><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[0][delete]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 0, 'delete')) ? 'checked' : ''; ?>/><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<?php echo form_hidden('role[1][module]', 'room'); ?>
		    				<tr>
		    					<td rowspan="8">Master</td>
		    					<td>Rooms Management Page</td>
		    					<td class="text-center">
									<label>
										<input name="role[1][menu]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 1, 'menu')) ? 'checked' : ''; ?>/><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[1][menu]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 1, 'menu')) ? 'checked' : ''; ?>/><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<tr>
		    					<td>Create Room</td>
		    					<td class="text-center">
									<label>
										<input name="role[1][create]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 1, 'create'))? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[1][create]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 1, 'create'))? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<tr>
		    					<td>Update Room</td>
		    					<td class="text-center">
									<label>
										<input name="role[1][update]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 1, 'update')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[1][update]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 1, 'update')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				<tr>
		    					<td>Delete Room</td>
		    					<td class="text-center">
									<label>
										<input name="role[1][delete]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 1, 'delete')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[1][delete]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 1, 'delete')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<?php echo form_hidden('role[2][module]', 'service'); ?>
		    				<tr>
		    					<td>Service Package Page</td>
		    					<td class="text-center">
									<label>
										<input name="role[2][menu]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 2, 'menu')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[2][menu]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 2, 'menu')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>			    				
		    				</tr>
		    				<tr>
		    					<td>Create Service Package</td>
		    					<td class="text-center">
									<label>
										<input name="role[2][create]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 2, 'create')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[2][create]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 2, 'create')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<tr>
		    					<td>Update Service Package</td>
		    					<td class="text-center">
									<label>
										<input name="role[2][update]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 2, 'update')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[2][update]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 2, 'update')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<tr>
		    					<td>Delete Service and Package</td>
		    					<td class="text-center">
									<label>
										<input name="role[2][delete]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 2, 'delete')) ? 'checked' : ''; ?>  /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[2][delete]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 2, 'delete')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<?php echo form_hidden('role[3][module]', 'customer'); ?>
		    				<tr>
		    					<td rowspan="4">Customers</td>
		    					<td>Customer Page</td>
		    					<td class="text-center">
									<label>
										<input name="role[3][menu]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 3, 'menu'))?'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[3][menu]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 3, 'menu'))?'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<tr>
		    					<td>Create Customer</td>
		    					<td class="text-center">
									<label>
										<input name="role[3][create]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 3, 'create')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[3][create]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 3, 'create')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<tr>
		    					<td>Update Customer</td>
		    					<td class="text-center">
									<label>
										<input name="role[3][update]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 3, 'update')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[3][update]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 3, 'update')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<tr>
		    					<td>Delete Customer</td>
		    					<td class="text-center">
									<label>
										<input name="role[3][delete]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 3, 'delete')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[3][delete]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 3, 'delete')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    				<?php echo form_hidden('role[4][module]', 'report'); ?>
		    				<tr>
		    					<td rowspan="4">Report</td>
		    					<td>Report Page</td>
		    					<td class="text-center">
									<label>
										<input name="role[4][menu]" class="ace ace-switch" type="radio"  value="1" required <?php echo ($this->user->role($get->role, 4, 'menu')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">
									<label>
										<input name="role[4][menu]" class="ace ace-switch" type="radio"  value="0" required <?php echo (!$this->user->role($get->role, 4, 'menu')) ? 'checked' : ''; ?> /><span class="lbl"></span>
									</label>
		    					</td>	
		    				</tr>
		    			</tbody>
		    		</table>
		    	</div>
		  	</div>			
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<a href="<?php echo site_url('user') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>

