<?php  
		$filter = array(
			'q' => $this->input->get('q'),
			'from' => $this->input->get('from'),
			'end' => $this->input->get('end'),
			'user' => $this->input->get('user'),
			'per_page' => $this->input->get('per_page') 
		);
?>
<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-2">
			<label>Show </label>
			<select name="per_page" id="input" class="select-page" onchange="window.location = '<?php echo site_url('report?per_page='); ?>' + this.value + '&q=<?php echo $this->input->get('q'); ?>';">
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
<?php  
// Form Filter
echo form_open(site_url('report'), array('method' => 'get'));
?>
		<div class="col-md-3">
			<a href="<?php echo site_url("report/print_out?q={$filter['q']}&per_page={$filter['per_page']}&from={$filter['from']}&end={$filter['end']}&user={$filter['user']}") ?>" target="_blank" class="btn btn-white btn-default btn-sm btn-bold btn-round">
				<i class="ace-icon fa fa-print gray"></i> Print
			</a>
			<a href="<?php echo site_url("report/export?q={$filter['q']}&per_page={$filter['per_page']}&from={$filter['from']}&end={$filter['end']}&user={$filter['user']}") ?>" target="_blank" class="btn btn-white btn-default btn-sm btn-bold btn-round">
				<i class="ace-icon fa fa-file-excel-o gray"></i> Export
			</a>
		</div>
		<div class="col-md-12">
			<div class="col-md-3">
				<label for="">Date</label>
				<div class="input-daterange input-group">
					<input type="text" class="input-sm form-control" name="from" value="<?php echo $this->input->get('from') ?>" placeholder="From date" />
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<span class="input-group-addon"><i class="fa fa-exchange"></i></span>
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" class="input-sm form-control" name="end" value="<?php echo $this->input->get('end') ?>" placeholder="End date" />
				</div>
			</div>
			<div class="col-md-3">
				<label for="">Keyword : </label>
				<input class="form-control input-sm" name="q" type="text" placeholder="Customer name .." value="<?php echo $this->input->get('q') ?>" />
			</div>
			<div class="col-md-3">
				<label for="">Cashier : </label>
				<select name="user" id="inputUser" class="form-control input-sm">
					<option value="">-- SELECT --</option>
					<?php 
					foreach($cashier as $row) :
						$selected = ($row->user_id==$this->input->get('user')) ? 'selected' : '';
						echo "<option value='{$row->user_id}' ".$selected.">{$row->full_name}</option>";
					endforeach;
					?>
				</select>
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-white btn-default btn-sm btn-bold btn-round" style="margin-top: 27px;">
					<i class="ace-icon fa fa-filter gray"></i> Filter
				</button>
				<a href="<?php echo site_url('pengajuan') ?>" class="btn btn-white btn-default btn-sm btn-bold btn-round" style="margin-top: 27px;">
					<i class="ace-icon fa fa-times gray"></i> Reset
				</a>
			</div>
		</div>
<?php  
// end form filter
echo form_close();
?>
	</div>
<?php  
// For Bulk Action
echo form_open(site_url('report/bulkaction'));
?>
	<div class="col-md-12">
		<div class="dotted hr"></div>
		<table class="table table-hover table-bordered">
			<thead>
				<tr class="mini-font">
					<th rowspan="2" width="30">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th width="100">
					<th rowspan="2">ID</th>
					<th rowspan="2" width="130">Date</th>
					<th rowspan="2">Customer Name</th>
					<th width="300" colspan="2" class="text-center">Items</th>
					<th rowspan="2">Tax</th>
					<th rowspan="2">Discount</th>
					<th rowspan="2">Total</th>
					<th rowspan="2">Cashier</th>
					<th rowspan="2" width="80"></th>
				</tr>
				<tr class="mini-font">
					<th>Package</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
<?php  
// Start Loops
$all_price = 0; $all_tax = 0; $all_discount = 0; $all_grandtotal = 0;
foreach($payments as $row) :
	$date = new DateTime($row->date);
	$total = $this->payment->total(
				array(
					'tax' => $row->tax_total,
					'discount' => $row->discount,
					'price' => $row->price
				)
			);
	$all_price += $row->price;
	$all_tax += $row->tax_total;
	$all_discount += $total['discount'];
	$all_grandtotal += $total['grandtotal'];
?>
				<tr>
					<td>
						<label class="pos-rel">
							<input type="checkbox" class="ace" name="payments[]" value="<?php echo $row->payment_id; ?>" /> <span class="lbl"></span>
						</label>	
					</td>
					<td><?php echo invoice_number($row->payment_id); ?></td>
					<td><?php echo $date->format('d/m/Y '); ?></td>
					<td><?php echo $row->name; ?></td>
					<td><?php echo $row->package_name; ?></td>
					<td><?php echo number_format($row->price) ?></td>
					<td><?php echo number_format($row->tax_total); ?></td>
					<td><?php echo ($row->discount != FALSE) ? number_format($total['discount']) : '-';  ?></td>
					<td><?php echo number_format($total['grandtotal']) ?></td>
					<td><?php echo $row->full_name; ?></td>
					<td class="text-center">
						<a class="gray" href="<?php echo site_url("report/printnota/{$row->payment_id}") ?>" target="_blank" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Print Struct">
							<i class="ace-icon fa fa-print bigger-130"></i>
						</a>
						<a class="green" href="<?php echo site_url("report/getpayment/{$row->payment_id}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Update">
							<i class="ace-icon fa fa-pencil bigger-130"></i>
						</a>
						<a class="red open-payment-delete" data-id="<?php echo $row->payment_id; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
							<i class="ace-icon fa fa-trash-o bigger-130"></i>
						</a>
					</td>
				</tr>
<?php  
endforeach;
?>
			</tbody>
			<thead>
				<tr>
					<th colspan="4">
						<small style="padding-right:20px;">With selected :</small>
						<a class="btn btn-minier btn-white btn-round btn-danger payment-delete-multiple" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
							<i class="ace-icon fa fa-trash-o"></i> <small> Delete</small>
						</a>
					</th>
					<th>
						<small style="padding-left:20px;">Showing <?php echo count($payments)."\nfrom\n".$total_rows; ?> records.</small>
						<small class="pull-right">Total : </small>
					</th>
					<th><?php echo number_format($all_price) ?></th>
					<th><?php echo number_format($all_tax) ?></th>
					<th><?php echo number_format($all_discount) ?></th>
					<th colspan="3"><?php echo number_format($all_grandtotal) ?></th>
				</tr>
			</thead>
		</table>
	</div>
		<div class="modal" id="modal-delete-multiple">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header bg-delete">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Transaction</h5>
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
<?php  
// End Form Bulk Action
echo form_close();
?>
</div>


<div class="modal" id="modal-delete">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Transaction</h5>
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