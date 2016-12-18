<div class="row">
	<div class="col-sm-2">
		<div class="infobox infobox-blue">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-money"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><?php echo number_format($this->main->sumIncome(date('Y-m-d'))) ?></span>
				<div class="infobox-content"> Income Today</div>
			</div>
		</div>
		<div class="space-6"></div>
		<div class="infobox infobox-orange2">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-exchange"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><?php echo $this->main->countTransactions(date('Y-m-d')); ?></span>
				<div class="infobox-content"> Transactions Today</div>
			</div>
		</div>
		<div class="space-6"></div>
		<div class="infobox infobox-pink">
			<div class="infobox-icon"> <i class="ace-icon fa fa-users"></i> </div>
			<div class="infobox-data">
				<span class="infobox-data-number"><?php echo $this->db->count_all('tb_customers'); ?></span>
				<div class="infobox-content">All Customers</div>
			</div>
		</div>
		<div class="space-6"></div>
		<div class="infobox infobox-green">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-bed"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><?php echo $this->main->countRooms(1) ?></span>
				<div class="infobox-content">Available Rooms</div>
			</div>
		</div>
		<div class="space-6"></div>
		<div class="infobox infobox-blue2">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-cogs"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><?php echo $this->db->count_all('tb_package') ?></span>
				<div class="infobox-content">Available Package</div>
			</div>
		</div>
		<div class="space-6"></div>
		<div class="infobox infobox-red">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-user"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number"><?php echo $this->db->count_all('tb_users') ?></span>
				<div class="infobox-content">User Application</div>
			</div>
		</div>
	</div>
	<div class="col-sm-10">
<?php  
echo form_open(site_url('main'), array('method' => 'get'));
?>
		<div class="col-sm-12">
			<div class="col-md-4 col-md-offset-1">
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
				<button type="submit" class="btn btn-white btn-default btn-sm btn-bold btn-round" style="margin-top: 27px;">
					<i class="ace-icon fa fa-filter gray"></i> Filter
				</button>
			</div>
		</div>
<?php  
echo form_close();
?>
		<div class="widget-box transparent col-sm-7">
			<div class="widget-header widget-header-flat">
				<h4 class="widget-title lighter"> <i class="ace-icon fa fa-signal"></i> Sale Stats </h4>
				<div class="widget-toolbar">
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main padding-4">
					<div id="sales-stats"></div>
				</div><!-- /.widget-main -->
			</div><!-- /.widget-body -->
		</div><!-- /.widget-box -->
		<div class="col-sm-4">
			<div class="widget-box transparent col-md-12">
				<div class="widget-header widget-header-flat">
					<h4 class="widget-title lighter"> <i class="ace-icon fa fa-star"></i> Favorites Packages</h4>
					<div class="widget-toolbar">
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div id="piechart-placeholder"></div>
					</div><!-- /.widget-main -->
				</div><!-- /.widget-body -->
			</div><!-- /.widget-box -->
		</div>

	</div>


</div>