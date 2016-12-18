<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpayment extends CI_Model {

	public function total(Array $data)
	{
		$total = ($data['price'] + $data['tax']);

		$discout_price = ($total * $data['discount']) / 100;
			
		$grandtotal = ($total - $discout_price);

		$calculate = array(
			'discount' => $discout_price, 
			'grandtotal' => $grandtotal
		);
		return $calculate;
	}

	public function get_all($limit = 10, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_booking', 'tb_payments.booking_payment_id = tb_booking.booking_id', 'left');
		$this->db->join('tb_customers', 'tb_booking.booking_customer_id = tb_customers.customer_ID', 'left');
		$this->db->join('tb_package', 'tb_booking.booking_package_id = tb_package.package_ID', 'left');
		$this->db->join('tb_users', 'tb_payments.user_cashier = tb_users.user_id', 'left');

		if($this->input->get('q') != '')
			$this->db->like('tb_customers.name', $this->input->get('q'))
					->or_like('tb_payments.payment_id', $this->input->get('q'));

		if($this->input->get('from') != '')
			$this->db->where('tb_booking.date >=', $this->input->get('from'));

		if($this->input->get('end') != '')
			$this->db->where('tb_booking.date <=', $this->input->get('end'));

		if($this->input->get('user') != '')
			$this->db->where('tb_payments.user_cashier', $this->input->get('user'));

		if($type == 'result')
		{
			return $this->db->get('tb_payments', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_payments')->num_rows();
		}
	}

	/**
	 * Get All Pyment Data
	 *
	 * @param Integer payment_id
	 * @return row
	 **/
	public function get($param = 0)
	{
		$this->db->join('tb_booking', 'tb_payments.booking_payment_id = tb_booking.booking_id', 'left');
		$this->db->join('tb_customers', 'tb_booking.booking_customer_id = tb_customers.customer_ID', 'left');
		$this->db->join('tb_package', 'tb_booking.booking_package_id = tb_package.package_ID', 'left');
		$this->db->join('tb_users', 'tb_payments.user_cashier = tb_users.user_id', 'left');	
		return $this->db->get_where('tb_payments', array('tb_payments.payment_id' => $param))->row();
	}

	/**
	 * Update All Payment Data
	 *
	 * @param Integer payment_id
	 * @return row
	 **/
	public function update($param = 0)
	{
		$package = $this->db->query("SELECT * FROM tb_package WHERE package_ID = ?", array($this->input->post('package')))->row();
		$get = $this->get($param);

		$total = $this->total(
				array(
					'tax' => $get->tax_total,
					'discount' => $this->input->post('discount'),
					'price' => $package->price
				)
		);

		$booking = array(
			'booking_package_id' => $package->package_ID,
			'date' => $this->input->post('date')
		);

		$this->db->update('tb_booking', array('booking_package_id' => $package->package_ID), array('booking_id' => $get->booking_id));

		$tax = ($package->price * $this->app('ppn_tax')) / 100;

		$payments = array(
			'tax_total' => $tax,
			'discount' => $this->input->post('discount'),
			'paid' => $this->input->post('cash'),
			'total_payments' => $total['grandtotal'],
			'user_cashier' => $this->session->userdata('user')->user_id
		);

		$this->db->update('tb_payments', $payments, array('payment_id' => $param));

		$this->template->alert(
			' Transaction changed.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	/**
	 * Delete All Payment Data
	 *
	 * @param Integer payment_id
	 * @return row
	 **/
	public function delete($param = 0)
	{
		$get = $this->get($param);

		$this->db->delete('tb_booking', array('booking_id' => $get->booking_id));

		$this->db->delete('tb_payments', array('payment_id' => $param));

		$this->template->alert(
			' Transaction deleted.', 
			array('type' => 'success','icon' => 'check')
		);
	}


	/**
	 * Multiple Delete All Payment Data
	 *
	 * @param Integer payment_id
	 * @return row
	 **/
	public function multiple_delete($param = 0)
	{
		if(is_array($this->input->post('payments')))
		{
			foreach ($this->input->post('payments') as $key => $value) 
			{
				$get = $this->get($value);

				$this->db->delete('tb_booking', array('booking_id' => $get->booking_id));

				$this->db->delete('tb_payments', array('payment_id' => $value));
			}
			$this->template->alert(
				' Transaction deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Empty selected.', 
				array('type' => 'danger','icon' => 'times')
			);
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

/* End of file Mpayment.php */
/* Location: ./application/modules/Report/models/Mpayment.php */