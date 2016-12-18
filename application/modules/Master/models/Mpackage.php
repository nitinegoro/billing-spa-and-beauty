<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpackage extends CI_Model {

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_rooms', 'tb_package.package_room = tb_rooms.ID_room', 'left');

		if($this->input->get('q') != '')
			$this->db->like('tb_package.package_name', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('tb_package', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_package')->num_rows();
		}
	}

	public function getroom()
	{
		$query = $this->db->query("SELECT * FROM tb_rooms");
		return $query->result();
	}

	public function insert()
	{
		$package = array(
			'package_name' => $this->input->post('name'),
			'duration' => $this->input->post('duration'),
			'package_description' => $this->input->post('description'),
			'price' => $this->input->post('price'),
			'package_room' => $this->input->post('room'),
			'package_status' => 'available' 
		);

		$this->db->insert('tb_package', $package);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Success adding package.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function get($param = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_package WHERE package_ID = ?", array($param));
		return $query->row();
	}

	public function update($param = 0)
	{
		$package = array(
			'package_name' => $this->input->post('name'),
			'duration' => $this->input->post('duration'),
			'package_description' => $this->input->post('description'),
			'price' => $this->input->post('price'),
			'package_room' => $this->input->post('room'),
		);

		$this->db->update('tb_package', $package, array('package_ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Package changed.', 
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
		$query = $this->db->query("SELECT * FROM tb_booking WHERE booking_package_id = ?", array($param));
		foreach($query->result() as $row) 
		{
			$this->db->delete('tb_payments', array('booking_payment_id' => $row->booking_id));
		}

		$this->db->delete('tb_booking', array('booking_package_id' => $param));

		$this->db->delete('tb_package', array('package_ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Package deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to delete data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function multiple_update()
	{
		if(is_array($this->input->post('packages')))
		{
			foreach($this->input->post('packages') as $key => $value)
			{
				$package = array(
					'package_name' => $this->input->post('name')[$key],
					'duration' => $this->input->post('duration')[$key],
					'package_description' => $this->input->post('description')[$key],
					'price' => $this->input->post('price')[$key],
					'package_room' => $this->input->post('room')[$key],
				);

				$this->db->update('tb_package', $package, array('package_ID' => $value));
			}
			$this->template->alert(
				' Package changed.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Empty selected.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function multiple_delete()
	{
		if(is_array($this->input->post('package')))
		{
			foreach($this->input->post('package') as $key => $value)
			{
				$query = $this->db->query("SELECT * FROM tb_booking WHERE booking_package_id = ?", array($value));
				foreach($query->result() as $row) 
				{
					$this->db->delete('tb_payments', array('booking_payment_id' => $row->booking_id));
				}

				$this->db->delete('tb_booking', array('booking_package_id' => $value));

				$this->db->delete('tb_package', array('package_ID' => $value));
			}
			$this->template->alert(
				' Package deleted.', 
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

/* End of file Mpackage.php */
/* Location: ./application/modules/Master/models/Mpackage.php */