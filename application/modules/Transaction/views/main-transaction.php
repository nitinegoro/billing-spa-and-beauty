<div class="row">
	<div class="col-xs-12">
		<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
		<div>
			<div class="row search-page" id="search-page-1">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12 col-sm-3">
							<div class="search-area well well-sm">
								<div class="search-filter-header bg-primary">
									<h5 class="smaller no-margin-bottom">
										<i class="ace-icon fa fa-plus white"></i> New Transaction 
									</h5>
								</div>
								<div class="space-10"></div>
								
								<form>
									<div class="row">
										<div class="form-group col-md-12">
											<a data-toggle="modal" data-target="#modal-customers" class="btn btn-block btn-xs">
												<i class="ace-icon fa fa-search icon-on-right"></i> Search customers
											</a>
										</div>
									</div>
								</form>
								<table class="table table-striped table-bordered" style="font-size: 11px;">
									<thead class="thin-border-bottom">
										<tr>
											<th> Items </th>
											<th> Price </th>
											<th></th>
										</tr>
									</thead>
									<tbody id="table-cart"></tbody>
									<tbody>
										<tr>
											<th><span class="pull-right">Total :</span> </th>
											<td colspan="2"><span class="tprice">0,00</span></td>
										</tr>
									</tbody>
								</table>
<?php  
echo form_open(site_url('transaction/setbooking'), array('class' => 'form-horizontal'));
?>
									<input type="hidden" name="room" id="booking-room" class="form-control input-sm" value="">
									<input type="hidden" name="package" id="booking-package" class="form-control input-sm" value="">
									<input type="hidden" name="customer_ID" id="booking-customer" class="form-control input-sm" value="">
									<div class="hr hr-dotted"></div>
									<div class="col-md-12">
										<label for="" class="control-label">Customer Name</label>
										<input id="customer-name" type="text" name="name" id="input" class="form-control input-sm" value="" required="">
									</div>
									<div class="col-md-12">
										<label for="" class="control-label">Phone Number</label>
										<input type="text" name="phone_number" id="customer-phone" class="form-control input-sm" value="">
									</div>
									<div class="col-md-12">
										<label for="" class="control-label">Address</label>
										<textarea id="customer-address" name="address" class="form-control input-sm" rows="2"></textarea>
									</div>
									<div class="col-md-12">
										<label for="request" class="control-label">Extra Request (Optional)</label>
										<textarea name="request" id="input-optional" class="form-control input-sm" rows="2"></textarea>
									</div>
								<div class="hr hr-dotted col-md-12"></div>
								<div class="text-center">
										<button type="reset" id="button-reset" class="btn btn-default btn-round btn-white">
										<i class="ace-icon fa fa-remove red2"></i> Reset
									</button>
									<button type="submit" class="btn btn-default btn-round btn-white">
										<i class="ace-icon fa fa-calendar green"></i> Booking Now
									</button>
								</div>
<?php  
echo form_close();
?>
								<div class="space-4"></div>
							</div>
						</div>

						<!-- Search book available -->

						<div class="col-sm-9">
							<div class="row">
								<div class="search-area well col-xs-12">
									<div class="pull-left col-md-6">
			<?php  
			echo form_open(site_url("transaction"), array('method' => 'get'));
			?>
									<div class="form-group">
										<div class="input-group">
											<input type="text" class="form-control input-sm" name="q" value="<?php echo $this->input->get('q') ?>" />
											<div class="input-group-btn">
												<button type="submit" class="btn btn-default no-border btn-xs">
													<i class="ace-icon fa fa-search icon-on-right"></i> Search rooms
												</button>
											</div>
										</div>
									</div>
			<?php  
			echo form_close();
			?>
									</div>
									<div class="pull-right col-md-4">
										<b class="text-primary">Select room status : </b>
										<select name="status" onchange="window.location = '<?php echo site_url("transaction?q={$this->input->get('q')}") ?>&status=' + this.value;">
											<option value="">-- SELECT -- </option>
											<option value="1" <?php echo ($this->input->get('status')) ? 'selected' : ''; ?>>Available</option>
											<option value="0" <?php echo ($this->input->get('status')=='0') ? 'selected' : ''; ?>>Unavailable</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
			<?php  
			// Loops Rooms
			foreach($rooms as $row) :
				if(!$row->room_status) :
				$booking = $this->transaction->getRoomBooking($row->ID_room);
			?>
				
										<div class=" col-xs-6 col-sm-4 col-md-3 col-lg-3">
											<div class="thumbnail search-thumbnail">
												<span class="search-promotion label label-gray arrowed-in arrowed-in-right">Unavailable</span>
								<?php  
								if($row->image != '') :
								?>
												<img src="<?php echo base_url("assets/images/{$row->image}"); ?>" alt="" class="img-responsive" width="200" height="200">
								<?php else : ?>
												<img class="media-object" data-src="holder.js/100px150?theme=gray" />
								<?php endif; ?>
												<div class="caption clearfix">
													<div class="clearfix"><?php echo $row->room_name; ?></div>
													<div class="text-center col-md-12">
														<span class="gray bolder bigger-150" id="time-<?php echo $booking->booking_id; ?>"></span>
													</div>
													<script>
														count_time('#time-<?php echo $booking->booking_id; ?>', '<?php echo $booking->booking_expired; ?>');
													</script>
													<small><i>Mr/Mrs :</i></small><p><?php echo $booking->name; ?></p>
													<small><i>Request :</i></small><p><?php echo $booking->request; ?></p>
													<a class="btn btn-minier btn-white btn-round btn-danger get-booking-delete" data-id="<?php echo $booking->booking_id; ?>">
														<i class="ace-icon fa fa-times"></i> <small> Cancel</small>
													</a>
													<a class="btn btn-minier btn-white btn-round btn-primary pull-right get-payments-modal" data-booking="<?php echo $booking->booking_id; ?>">
														<i class="ace-icon fa fa-credit-card"></i> <small> Get Payment</small>
													</a>
												</div>
											</div>
										</div>
			<?php  
				else :
			?>
										<div class=" col-xs-6 col-sm-4 col-md-3 col-lg-3">
											<div class="thumbnail search-thumbnail">
												<span class="search-promotion label label-success arrowed-in arrowed-in-right">Available</span>
								<?php  
								if($row->image != '') :
								?>
												<img src="<?php echo base_url("assets/images/{$row->image}"); ?>" alt="" class="img-responsive" width="200" height="200">
								<?php else : ?>
												<img class="media-object" data-src="holder.js/100px150?theme=gray" />
								<?php endif; ?>

												<div class="caption">
													<div class="clearfix">
														<div class="pull-left">
															<p class="room-name"><?php echo $row->room_name; ?></p>
														</div>
													</div>
													<a href="#" class="btn btn-sm btn-white btn-round btn-block btn-success get-modal-package" data-room="<?php echo $row->ID_room; ?>">
															<i class="ace ace-icon fa fa-hand-o-left"></i> <small> Book it</small>
													</a>
												</div>
											</div>
										</div>
			<?php
				endif;
			endforeach;
			if(!$rooms) :
			?>	
			<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Empty data.
			</div>
			<?php  
			endif;
			?>
							<span class="gray bolder bigger-150 selector"></span>
								<div class="clearfix"></div>
								
							</div>
							<div class="row">
								<div class="col-md-12 text-right">
									<?php echo $this->pagination->create_links(); ?>
								</div>
							</div>
							<div class="space-12"></div>
						</div>
						<!-- End -->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>








<div class="modal animated fadeIn" id="modal-payments"  tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title">Confirm Payment</h5>
			</div>
<?php  
// open form
echo form_open('', array('onsubmit' => 'return save_transaction();', 'id' => 'form-payment'));
?>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<i>Mr/Mrs :</i>
						<ul class="list-unstyled spaced">
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i><span id="incustomer-name"></span>
							</li>
							<li>
								<i class="ace-icon fa fa-caret-right blue"></i> <span id="incustomer-address"></span>
							</li>
						</ul>
					</div>
					<div class="col-md-4 pull-right">
						<div class="widget-toolbar no-border invoice-info">
							<span class="invoice-info-label">Date:</span>
							<span class="blue"><?php echo date('d/m/Y H:i A') ?></span>
						</div>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered">
							<thead class="thin-border-bottom">
								<tr>
									<th> Items </th> <th width="280"> Price </th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td id="item-value"></td> <td id="item-price"></td>
								</tr>
							</tbody>
							<tbody>
								<tr>
									<td><span class="pull-right">Tax :</span> </td>
									<td colspan="2"><span class="bigger-110" id="tax-amount">0,00</span> <span><?php echo ($this->app->get('ppn_tax') != '') ? "(".$this->app->get('ppn_tax')."%)" :''; ?></span></td>
								</tr>
								<tr>
									<td><span class="pull-right">Discount :</span> </td>
									<td colspan="2"><span class="bigger-110" id="discount-total">0,00</span></td>
								</tr>
								<tr>
									<th><span class="pull-right">Total :</span> </th>
									<td colspan="2"><span class="bigger-150" id="total-amount"></span></td>
								</tr>
								<input type="hidden" id="total-value">
								<input name="booking" type="hidden" id="booking-id">
								<tr>
									<td colspan="3">
										<div class="form-group col-md-4 pull-right">
											<input type="text" name="discount" id="input-discount" class="form-control input-lg" value="" placeholder="Discount (%)">
											<input type="text" name="cash" id="input-cash" class="form-control input-lg" value="" required="required" placeholder="Cash ..">
										</div>
									</td>
								</tr>
								<tr>
									<th><span class="pull-right">Change :</span> </th>
									<td colspan="2"><span class="bigger-150" id="change-value">0</span></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-white btn-round pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				<button type="submit" class="btn btn-primary btn-white btn-round"><i class="fa fa-credit-card"></i> Paid Now</button>
			</div>
<?php  
// end form
echo form_close();
?>
		</div>
	</div>
</div>

<?php  
if($this->input->get('print')!='') :
?>
<script>print_nota('<?php echo $this->input->get('print'); ?>');</script>
<?php  
endif;
?>	


<div class="modal" id="modal-delete-booking">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete User</h5>
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


<div class="modal fade" id="modal-list-customer">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cutomers List</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right btn-white btn-round" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-list-package" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-terima">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Packages List</h4>
			</div>
<?php  
	echo form_open('', array('id' => 'form-select-package', 'onsubmit' => 'return add_cart();'));
?>
			<div class="modal-body">

				  	<select name="package" id="inputSelect-Package" class="form-control input-lg" required="required">
				  		<option value="">-- SELECT --</option>
				  	</select>
				<div id="progress" style="margin-top:-30px;"> <div class="loader"></div></div>
			</div>
			<input type="hidden" id="booking-room-id" name="room-id">
			<div class="modal-footer">
				<button id="close-package" type="button" class="btn btn-danger pull-left btn-white btn-round" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				<button type="submit" class="btn btn-primary pull-right btn-white btn-round"><i class="fa fa-check"></i> Select Package</button>
			</div>
<?php  
	echo form_close();
?>
		</div>
	</div>
</div>


<div class="modal" id="modal-delete-cart">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Are you sure?</h4>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning pull-left btn-white btn-round" data-dismiss="modal"> <i class="fa fa-times"></i> Cancel</button>
				<a id="yes-delete-cart" class="btn btn-danger pull-right btn-white btn-round"><i class="fa fa-trash-o"></i> Delete</a>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-customers">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Customers List</h4>
			</div>
<?php  
	echo form_open('', array('id' => 'form-select-customer', 'onsubmit' => 'return add_customer();'));
?>

			<div class="modal-body no-padding">
				<table id="table-customers" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" width="100%">
					<thead>
						<tr>
							<th width="50"></th>
							<th>Name</th>
							<th>Gender</th>
							<th>Phone</th>
							<th>E-Mail</th>
							<th>Address</th>
						</tr>
					</thead>
					<tbody>
	<?php  
	// start Loop customers
	foreach($customers as $row) :
	?>
						<tr>
							<td class="text-center">
								<label>
									<input id="radio-customer-<?php echo $row->customer_ID; ?>" name="select-customer" class="ace ace-switch input-lg" type="radio" value="<?php echo $row->customer_ID; ?>" required="" /><span class="lbl"></span>
								</label>
							</td>
							<td class="pointer" onclick="return checked('#radio-customer-<?php echo $row->customer_ID; ?>');"><?php echo $row->name; ?></td>
							<td class="pointer" onclick="return checked('#radio-customer-<?php echo $row->customer_ID; ?>');"><?php echo ucfirst($row->gender); ?></td>
							<td class="pointer" onclick="return checked('#radio-customer-<?php echo $row->customer_ID; ?>');"><?php echo $row->email; ?></td>
							<td><?php echo $row->phone_number; ?></td>
							<td width="200"><?php echo $row->address; ?></td>
						</tr>
	<?php  
	endforeach;
	?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning pull-left btn-white btn-round" data-dismiss="modal"> <i class="fa fa-times"></i> Cancel</button>
				<button type="submit" class="btn btn-primary pull-right btn-white btn-round"><i class="fa fa-check"></i> Select Customer</button>
			</div>
<?php  
	echo form_close();
?>
		</div>
	</div>
</div>