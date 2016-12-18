<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransaction extends CI_Model 
{
	public function getRoom($limit = 12, $offset = 0, $type = 'result')
	{
		if($this->input->get('status') != '')
			$this->db->where('room_status', $this->input->get('status'));

		if($this->input->get('q') != '')
			$this->db->like('room_name', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('tb_rooms', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_rooms')->num_rows();
		}
	}

	/**
	 * List Package
	 *
	 * @return Array
	 **/
	public function getPackage()
	{
		$query = $this->db->query("SELECT * FROM tb_package WHERE package_status = 'available'");
		return $query->result();
	}

	/**
	 * List Package
	 *
	 * @return Array
	 **/
	public function getPackageByRomm($param)
	{
		$query = $this->db->query("SELECT * FROM tb_package WHERE package_status = 'available' AND package_room = ?", array($param));
		return $query->result();
	}

	/**
	 * Ambil data booking
	 *
	 * @param Integer room_id
	 * @return Row
	 **/
	public function getRoomBooking($room = 0)
	{
		$query = $this->db->query("
			SELECT tb_customers.name, tb_customers.address, tb_booking.*, tb_package.* FROM tb_booking
			LEFT JOIN tb_customers ON tb_customers.customer_ID = tb_booking.booking_customer_id 
			JOIN tb_package ON tb_package.package_id = tb_booking.booking_package_id
			WHERE tb_booking.booking_status = 'process' AND tb_booking.booking_room_id = ? 
		", array($room));
		return $query->row();
	}

	/**
	 * Ambil data room saru
	 *
	 * @param Integer room_id
	 * @return Row
	 **/
	public function getRoomOne($room = 0)
	{
		$query = $this->db->query(" SELECT * FROM tb_rooms WHERE ID_room = ? ", array($room));
		return $query->row();
	}

	/**
	 * Ambil data package saru
	 *
	 * @param Integer package_ID
	 * @return Row
	 **/
	public function getpackageOne($package = 0)
	{
		$query = $this->db->query(" SELECT * FROM tb_package WHERE package_ID = ? ", array($package));
		return $query->row();
	}

	/**
	 * Ambil data booking
	 *
	 * @param Integer Booking id
	 * @return Row
	 **/
	public function getBooking($room = 0)
	{
		$query = $this->db->query("
			SELECT tb_customers.*, tb_booking.*, tb_package.*, tb_rooms.* FROM tb_booking
			LEFT JOIN tb_customers ON tb_customers.customer_ID = tb_booking.booking_customer_id 
			JOIN tb_package ON tb_package.package_id = tb_booking.booking_package_id
			JOIN tb_rooms ON tb_rooms.ID_room = tb_booking.booking_room_id 
			WHERE tb_booking.booking_status = 'process' AND tb_booking.booking_id = ? 
		", array($room));
		return $query->row();
	}

	/**
	 * Insert Transaction to payments
	 *
	 * @param Integer Booking_id
	 * @var string
	 **/
	public function insert()
	{
		$get = $this->db->query("
			SELECT tb_customers.*, tb_booking.*, tb_package.*, tb_rooms.* FROM tb_booking
			LEFT JOIN tb_customers ON tb_customers.customer_ID = tb_booking.booking_customer_id 
			JOIN tb_package ON tb_package.package_id = tb_booking.booking_package_id
			JOIN tb_rooms ON tb_rooms.ID_room = tb_booking.booking_room_id 
			WHERE tb_booking.booking_id = ? 
		", array($this->input->post('booking')))->row();

		$tax = ($get->price * $this->app('ppn_tax')) / 100;
		$total = $get->price + $tax;

		$discount = (!$this->input->post('discount')) ? '' : $this->input->post('discount');
		$discout_price = ($total * $discount) / 100;
			
		$grandtotal = $total - $discout_price;

		if($this->input->post('cash') >= $total)
		{
			$calculate = ( $this->input->post('cash') - $grandtotal );
		} else {
			$calculate = 0;
		}

		$this->db->update('tb_rooms', array('room_status' => 1), array('ID_room' => $get->booking_room_id));
		$this->db->update('tb_booking', array('booking_status'=>'success'), array('booking_id' => $get->booking_id));

		$payments = array(
			'booking_payment_id' => $this->input->post('booking'),
			'tax_total' => $tax,
			'discount' => $this->input->post('discount'),
			'paid' => $this->input->post('cash'),
			'total_payments' => $grandtotal,
			'user_cashier' => $this->session->userdata('user')->user_id
		);

		$this->db->insert('tb_payments', $payments);
	}

	/**
	 * Delete Pemesanan
	 *
	 * @param Integer booking_id
	 * @return String
	 **/
	public function deleteBooking($param = 0)
	{
		$get = $this->getbooking($param);
		$this->db->update('tb_rooms', array('room_status' => 1), array('ID_room' => $get->booking_room_id));
		$this->db->delete('tb_booking', array('booking_id' => $param));

		$this->template->alert(
			' Transaction deleted.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	/**
	 * Get data payment detail
	 *
	 * @param Integer (booking_id)
	 * @return Row
	 **/
	public function getPayments($param = 0)
	{
		$query = $this->db->query("
			SELECT tb_customers.*, tb_booking.*, tb_package.*, tb_rooms.*, tb_payments.* FROM tb_booking
			LEFT JOIN tb_customers ON tb_customers.customer_ID = tb_booking.booking_customer_id 
			JOIN tb_package ON tb_package.package_id = tb_booking.booking_package_id
			JOIN tb_rooms ON tb_rooms.ID_room = tb_booking.booking_room_id 
			JOIN tb_payments ON tb_payments.booking_payment_id = tb_booking.booking_id
			WHERE tb_booking.booking_id = ? 
		", array($param));
		return $query->row();
	}

	/**
	 * Get All data Customers
	 *
	 * @param Integer customer_ID
	 * @return Result
	 **/
	public function customers($param = 0)
	{
		if(!$param) 
		{
			$query = $this->db->query("
				SELECT * FROM tb_customers ORDER BY name
			");
			return $query->result();
		} else {
			$query = $this->db->query("
				SELECT * FROM tb_customers WHERE customer_ID = ?
			", array($param));
			return $query->row();	
		}

	}

	/**
	 * Insert Transaction to tb_booking
	 *
	 * @param Integer
	 * @return String
	 **/
	public function setBooking()
	{
		$package = $this->getpackageOne($this->input->post('package')); 

		$customer = (!$this->input->post('customer_ID')) ? $this->transaction->insert_customer() : $this->input->post('customer_ID');

		$this->db->update('tb_rooms', array('room_status'=>'0'), array('ID_room' => $this->input->post('room')));

		$booking = array(
			'booking_room_id' => $this->input->post('room'),
			'booking_package_id' => $this->input->post('package'),
			'date' => date('Y-m-d'),
			'booking_expired' => set_duration($package->duration),
			'month' => date('m'),
			'year' => date('Y'),
			'booking_status' => 'process',
			'request' => $this->input->post('request'),
			'booking_customer_id' =>(!$this->input->post('customer_ID')) ? $customer : $this->input->post('customer_ID')
		);

		$this->db->insert('tb_booking', $booking);

		$this->template->alert(
			' New transaction added.', 
			array('type' => 'success','icon' => 'check')
		);		
	}

	/**
	 * Create New Customer
	 *
	 * @access private
	 * @return String
	 **/
	private function insert_customer()
	{
		$customer = array(
			'name' => $this->input->post('name'),
			'gender' => '-',
			'births' => '-',
			'phone_number' => $this->input->post('phone_number'),
			'email' => '-',
			'address' => $this->input->post('address'),
			'job' => '-'
		);

		$this->db->insert('tb_customers', $customer);

		return $this->db->insert_id();
	}

	/**
	 * Get data option
	 *
	 * @param String (option_name)
	 * @return string
	 **/
	public function app($value='')
	{
		if(is_string($value))
		{
			$query = $this->db->query("SELECT option_value FROM tb_options WHERE option_name = ?", array($value));

			if(!$query->num_rows())
				return false;

			return $query->row()->option_value;
		} else {
			return false;
		}
	}

}

/* End of file Mtransaction.php */
/* Location: ./application/modules/Transaction/models/Mtransaction.php */