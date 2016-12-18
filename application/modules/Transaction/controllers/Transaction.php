<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends Application 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->js(base_url('assets/app/transaksi.js'));

		$this->load->model('mtransaction', 'transaction');

		$this->page_title->push('Transaction', '');
	}

	public function index()
	{
		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("transaction?q=");
		$config['per_page'] = 12;
		$config['total_rows'] = $this->transaction->getRoom(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Main",
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'rooms' => $this->transaction->getRoom($config['per_page'], $this->input->get('page')),
			'packages' => $this->transaction->getPackage(),
			'customers' =>  $this->transaction->customers(null)
		);
		$this->template->view('main-transaction', $this->data);

	}

	/**
	 * Get Data Booking
	 *
	 * @param Integer booking_id
	 * @return String
	 **/
	public function getbooking($param = 0)
	{
		$get = $this->transaction->getbooking($param);
		$tax = ($get->price * $this->app->get('ppn_tax')) / 100;
		$array = array(
			'price' => number_format($get->price),
			'total_amount' => number_format($get->price + $tax), 
			'tax_amount' => number_format($tax)
		);
		$output = array($get, $array);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Hitung pembelanjaan
	 *
	 * @param Integer booking_id
	 * @return String
	 **/
	public function calculate($param = 0)
	{
		$get = $this->transaction->getbooking($param);

		$tax = ($get->price * $this->app->get('ppn_tax')) / 100;
		$total = $get->price + $tax;
		$discount = (!$this->input->get('disc')) ? '' : $this->input->get('disc');
		$discout_price = ($total * $discount) / 100;
			
		$grandtotal = $total - $discout_price;

		if( $this->input->get('cash') != '')
		{
			$calculate = ( $this->input->get('cash') - $grandtotal );
			
			$output = array(
				'status' => 'OK',
				'change' => number_format($calculate),
				'total_amount' => number_format($grandtotal),
				'total_discount' => number_format($discout_price)
			);
		} else {
			$output = array(
				'status' => 'ERROR',
				'total_amount' => number_format($grandtotal),
				'change' => '',
			);
		}	

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Insert Transaction
	 *
	 * @var string
	 **/
	public function insert()
	{
		$this->transaction->insert();
		$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'OK', 'ID' => $this->input->post('booking'))));
	}

	/**
	 * Hitung pembelanjaan
	 *
	 * @param Integer booking_id
	 * @return String
	 **/
	public function print_out($param = 0)
	{
		$get = $this->transaction->getPayments($param);
		$this->load->view('print_nota', array('get'=>$get));
	}

	/**
	 * undocumented class variable
	 *
	 * @param Integer (booking_id)
	 * @return Void
	 **/
	public function delete($param = 0)
	{
		$this->transaction->deleteBooking($param);
		redirect('transaction');
	}

	/**
	 * Add To Cart 
	 *
	 * @return string
	 **/
	public function addcart()
	{
		if($this->input->post('room-id') != '' AND $this->input->post('package') != '')
		{
			if(!$this->transaction->getRoomOne($this->input->post('room-id')) OR !$this->transaction->getpackageOne($this->input->post('package')))
			{
				$output = array('status' => 'ERROR', 'message' => "Not found Data.");
			} else {
				$room = $this->transaction->getRoomOne($this->input->post('room-id'));
				$package = $this->transaction->getpackageOne($this->input->post('package'));
				$output = array(
					'status' => "OK",
					'result' => array($room, $package) ,
					'price' => number_format($package->price )
				);
			}
		} else {
			$output = array('status' => 'ERROR', 'message' => "Empty data selected.");
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output, JSON_PRETTY_PRINT));
	}

	/**
	 * Set booking Data
	 *
	 * @return void
	 **/
	public function setbooking()
	{
		$this->transaction->setbooking();
		redirect('transaction');
	}

	/**
	 * Get All Data Customers
	 *
	 * @param Integer (cutomer_ID)
	 * @return String
	 **/
	public function getcustomer()
	{
		$customers = $this->transaction->customers($this->input->post('select-customer'));

		if(!$customers)
		{
			$output = array('status' => 'ERROR', 'message' => "Not found Data.");
		} else {
			$output = array('status' => 'OK', 'result' => $customers);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output, JSON_PRETTY_PRINT));
	}


	/**
	 * GetPackage Id
	 *
	 * @return Result
	 **/
	public function getPackage($room = 0)
	{
		$package = $this->transaction->getPackageByRomm($room);

		$output = array();
		if(!$package)
		{
			$output = array('status' => 'ERROR');
			$output['results'] = array();
		} else {
			$output = array('status' => 'OK');
			foreach($package as $row)
			{
				$output['results'][] = array(
					'ID' => $row->package_ID,
					'radio'=> '<label><input id="radio-package-'.$row->package_ID.'" name="select-package" class="ace ace-switch input-lg" type="radio" value="'.$row->package_ID.'" required="" /><span class="lbl"></span></label>',
					'name' => $row->package_name,
					'duration' => $row->duration,
					'price' => number_format($row->price)
				);
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output, JSON_PRETTY_PRINT));
	}

}

/* End of file Transaction.php */
/* Location: ./application/modules/Transaction/controllers/Transaction.php */