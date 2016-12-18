<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option extends CI_Model {

	private $data = array();

	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * Get data option
	 *
	 * @param String (option_name)
	 * @return string
	 **/
	public function get($value='')
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

	/**
	 * updating data option
	 *
	 * @param String (option_name)
	 * @return Boolean
	 **/
	public function update($name = '', $value = '')
	{
		if(is_string($name) OR $name != '')
		{
			$query = $this->db->query("UPDATE tb_options SET option_value = ? WHERE option_name = ?", array($value, $name));
			return $this->db->affected_rows();
		} else {
			return false;
		}
	}

	/**
	 * Ambil data privileges
	 *
	 * @return Boolean (string)
	 **/
	public function role($module_number = 0, $obj = 'menu')
	{
		$user_id = $this->session->userdata('user')->user_id;

		// biar greget select data role_access lagi
		$json = $this->db->query("
			SELECT tb_role_access.role, tb_users.user_id FROM tb_users 
			LEFT JOIN tb_role_access ON tb_users.role_id = tb_role_access.role_id 
			WHERE tb_users.user_id = ?", array($user_id))->row('role');

		$data = json_decode($json);

		// pilih data yang akan diambil
		$role_value = $data[$module_number]->$obj;
		return $role_value;	
	}


	/**
	 * Get data Cashier
	 *
	 * @return Result
	 **/
	public function cashier()
	{
		$query = $this->db->query("SELECT * FROM tb_users ORDER BY user_id DESC");
		return $query->result();
	}

}

/* End of file Option.php */
/* Location: ./application/models/Option.php */