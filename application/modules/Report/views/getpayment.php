<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-8 col-md-offset-1" style="margin-top: 30px;">
	<?php 
	$total = $this->payment->total(
				array(
					'tax' => $get->tax_total,
					'discount' => $get->discount,
					'price' => $get->price
				)
			);

	echo form_open(site_url("report/updatepayment/{$get->payment_id}"), array('class' => 'form-horiontal', 'id' => '')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="name" class="col-sm-2 control-label">ID</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="name" value="<?php echo invoice_number($get->payment_id) ?>" disabled="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="name" class="col-sm-2 control-label">Customer Name</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="name" value="<?php echo $get->name; ?>" disabled="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="births" class="col-sm-2 control-label">Date</label>
		    	<div class="col-sm-4">
					<div class="input-group bootstrap-timepicker">
						<input name="births" type="text" class="form-control date-picker" placeholder="Ex : <?php echo date('Y-m-d') ?>" value="<?php echo $get->date; ?>"  />
						<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
						</span>
					</div>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="gender" class="col-sm-2 control-label">Package</label>
		    	<div class="col-sm-10">
		      		<select name="package" class="form-control input-lg" required="">
		      			<option value="">-- SELECT --</option>
					<?php 
					foreach($packages as $row) :
						$selected = ($row->package_ID==$get->booking_package_id) ? 'selected' : '';
						echo "<option value='{$row->package_ID}' ".$selected.">{$row->package_name} - ".number_format($row->price)."</option>";
					endforeach;
					?>
		      		</select>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="price" class="col-sm-2 control-label">Price</label>
		    	<div class="col-sm-6">
		      		<input type="text" class="form-control" name="price" value="<?php echo $get->price; ?>" disabled="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="phone_number" class="col-sm-2 control-label">Tax</label>
		    	<div class="col-sm-6">
		      		<input type="text" class="form-control" name="phone_number" value="<?php echo $get->tax_total; ?>" disabled="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="discount" class="col-sm-2 control-label">Discount</label>
		    	<div class="col-sm-5">
		      		<input type="text" class="form-control input-lg" name="discount" value="<?php echo $get->discount; ?>" placeholder="Ex 0.5">
		    	</div>
		    	<div class="col-sm-5">
		      		<input type="email" class="form-control input-lg" name="email" value="<?php echo number_format($total['discount']) ?>" disabled="0,00">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="job" class="col-sm-2 control-label">Total</label>
		    	<div class="col-sm-5">
		      		<input type="text" class="form-control input-lg" name="total" value="<?php echo number_format($total['grandtotal']); ?>" disabled="">
		    	</div>
		  	</div>

		  	<div class="form-group col-md-12">
		    	<label for="job" class="col-sm-2 control-label">Chash</label>
		    	<div class="col-sm-5">
		      		<input type="text" class="form-control input-lg" name="cash" value="<?php echo $get->paid; ?>">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="job" class="col-sm-2 control-label">Change</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control input-lg" value="<?php echo number_format(($get->paid-$get->total_payments)) ?>" disabled="">
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
		<div class="col-md-2">
			<div class="btn-group col-md-12">
				<a href="<?php echo site_url("report/printnota/{$get->payment_id}") ?>" target="_blank" class="btn btn-app btn-light btn-sm pull-right">
					<i class="ace-icon fa fa-print bigger-160 btnPrint"></i> Print
				</a>
			</div>
		</div>
	</div>

</div>
