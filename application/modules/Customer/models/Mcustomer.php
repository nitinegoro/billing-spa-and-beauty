<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcustomer extends CI_Model {

	public function get_all($limit = 10, $offset = 0, $type = 'result')
	{
		if($this->input->get('q') != '')
			$this->db->like('name', $this->input->get('q'))
					->or_like('address', $this->input->get('q'))
					->or_like('job', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('tb_customers', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_customers')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_customers WHERE customer_ID = ?", array($param));
		return $query->row();
	}

	public function insert()
	{
		$customer = array(
			'name' => $this->input->post('name'),
			'gender' => $this->input->post('gender'),
			'births' => $this->input->post('births'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'job' => $this->input->post('job') 
		);

		$this->db->insert('tb_customers', $customer);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Success adding customer.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function update($param = 0)
	{
		$customer = array(
			'name' => $this->input->post('name'),
			'gender' => $this->input->post('gender'),
			'births' => $this->input->post('births'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'job' => $this->input->post('job') 
		);

		$this->db->update('tb_customers', $customer, array('customer_ID' =>$param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Customer changed.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function delete($param = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_booking WHERE booking_customer_id = ?", array($param));
		foreach($query->result() as $row) 
		{
			$this->db->delete('tb_payments', array('booking_payment_id' => $row->booking_id));
		}
		$this->db->delete('tb_booking', array('booking_customer_id' => $param));

		$this->db->delete('tb_customers', array('customer_ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Customer deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to delete data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}		
	}

	public function multiple_delete()
	{
		if(is_array($this->input->post('customers')))
		{
			foreach ($this->input->post('customers') as $key => $value) 
			{
				$query = $this->db->query("SELECT * FROM tb_booking WHERE booking_customer_id = ?", array($value));
				foreach($query->result() as $row) 
				{
					$this->db->delete('tb_payments', array('booking_payment_id' => $row->booking_id));
				}
				$this->db->delete('tb_booking', array('booking_customer_id' => $value));

				$this->db->delete('tb_customers', array('customer_ID' => $value));
			}
			$this->template->alert(
				' Customer deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Empty selected.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}
}

/* End of file Mcustomer.php */
/* Location: ./application/modules/Customer/models/Mcustomer.php */