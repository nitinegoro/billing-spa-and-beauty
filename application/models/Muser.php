<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_role_access', 'tb_users.role_id = tb_role_access.role_id', 'left');
		// searching fields data
		//$this->db->where_not_in('user_id', 1);
		
		if($this->input->get('q') != '')
			$this->db->like('full_name', $this->input->get('q'));
		if($this->input->get('q') != '')
			$this->db->or_like('user_email', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('tb_users', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_users')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$query = $this->db->query("
			SELECT tb_users.*, tb_role_access.* FROM tb_users 
			LEFT JOIN tb_role_access ON tb_users.role_id = tb_role_access.role_id
			WHERE tb_users.user_id = ? ", array($param));

		return $query->row();
	}


	/**
	 * Inserting data
	 *
	 * @return String
	 **/
	public function insert()
	{
		$user = array(
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'full_name' => $this->input->post('full_name'),
			'user_email' => $this->input->post('email'),
			'user_phone' => $this->input->post('phone'),
			'registered' => date('Y-m-d H:i:s'),
			'role_id' => $this->input->post('role')
		);

		$this->db->insert('tb_users', $user);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Success adding user.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Updating data
	 *
	 * @param Integer ID_user
	 * @return String
	 **/
	public function update($param = 0)
	{
		$get = $this->get($param);

		$user = array(
			'full_name' => (!$this->input->post('full_name')) ? $get->full_name : $this->input->post('full_name'),
			'user_email' => (!$this->input->post('email')) ? $get->user_email : $this->input->post('email'),
			'user_phone' => (!$this->input->post('phone')) ? $get->user_phone : $this->input->post('phone'),
			'role_id' => (!$this->input->post('role')) ? $get->role_id : $this->input->post('role')
		);

		$this->db->update('tb_users', $user, array('user_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Users changes.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Deleting data
	 *
	 * @param Integer ID_user
	 * @return String
	 **/
	public function delete($param  = 0)
	{
		$get = $this->get($param);

		$this->db->delete('tb_users', array('user_id' => $param));

		$this->template->alert(
			' Users deleted.', 
			array('type' => 'success','icon' => 'check')
		);
	}


	/**
	 * Multiple Update user
	 *
	 * @return string
	 **/
	public function multiple_update()
	{
		if(is_array($this->input->post('users')))
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$get = $this->get($value);

				$user = array(
					'full_name' => (!$this->input->post('full_name')[$key]) ? $get->full_name : $this->input->post('full_name')[$key],
					'user_email' => (!$this->input->post('email')[$key]) ? $get->user_email : $this->input->post('email')[$key],
					'user_phone' => (!$this->input->post('phone')[$key]) ? $get->user_phone : $this->input->post('phone')[$key],
					'role_id' => (!$this->input->post('role')[$key]) ? $get->role_id : $this->input->post('role')[$key]
				);

				$this->db->update('tb_users', $user, array('user_id' => $value));
			}
			$this->template->alert(
				' Users changes.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Multiple Delete user
	 *
	 * @return string
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('users')))
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$this->db->delete('tb_users', array('user_id' => $value));
			}
			$this->template->alert(
				' Users deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to remove.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Update passowrd and username account
	 *
	 * @param session id
	 * @return String
	 **/
	public function update_account()
	{
		$get = $this->get($this->session->userdata('user')->user_id);

		$old_pass = password_hash($this->input->post('old_pass'), PASSWORD_DEFAULT);
		$new_pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$user = array(
			'username' => (!$this->input->post('username')) ? $get->username : $this->input->post('username'),
			'password' => (!$this->input->post('password')) ? $old_pass : $new_pass,
		);

		$this->db->update('tb_users', $user, array('user_id' => $get->user_id));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Login setting changes.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Get Role Acces (tb_role_access)
	 *
	 * @param Integer
	 * @return Query
	 **/
	public function get_role($role = FALSE)
	{
		if ($role == TRUE) 
		{
			$query = $this->db->query("SELECT role_id, role_name, description, role FROM tb_role_access WHERE role_id = ?", array($role));

		} 
		else {
			$query = $this->db->query("SELECT role_id, role_name, description, role FROM tb_role_access");
		}

		return $query;
	}

	/**
	 * Handle Insert Privileges
	 *
	 * @return string
	 **/
	public function insertPrivileges()
	{
		$data = array(
			'role_name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'role' => json_encode($this->input->post('role')) 
		);

		$this->db->insert('tb_role_access', $data);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Success adding Privileges.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Handle Insert Privileges
	 *
	 * @return string
	 **/
	public function updatePrivileges($param = 0)
	{
		$data = array(
			'role_name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'role' => json_encode($this->input->post('role')) 
		);

		$this->db->update('tb_role_access', $data, array('role_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Privileges Changes.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Get data role (Convert to string)
	 *
	 * @return string
	 **/
	public function role($json, $module_number = 0, $obj = 'menu')
	{
		$data = json_decode($json);
		$role_value = $data[$module_number]->$obj;
		return $role_value;
	}

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public function deletePrivileges($param = 0)
	{
		$this->db->delete('tb_role_access', array('role_id' => $param));

		$this->db->update('tb_users', array('role_id' => 2), array('role_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Success deleting Privileges.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to remove data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}
}

/* End of file Muser.php */
/* Location: ./application/models/Muser.php */