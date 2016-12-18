<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Application 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->js(base_url('assets/app/user.js'));

		$this->load->model('muser', 'user');

		$this->breadcrumbs->unshift(1, 'Settings', 'user');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'All Users', 'user');

		$this->page_title->push('Settings', 'All Users');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("user?q={$this->input->get('q')}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->user->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "All Users",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'users' => $this->user->get_all($config['per_page'], $this->input->get('page')),
			'role_access' => $this->user->get_role()
		);
		$this->template->view('user/semua_user', $this->data);
	}

	public function adduser()
	{
		$this->breadcrumbs->unshift(2, 'All Users', 'user');

		$this->breadcrumbs->unshift(3, 'Add User', 'adduser');
		$this->page_title->push('Settings', 'Add User');

		$this->data = array(
			'title' => "Add User",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'role_access' => $this->user->get_role()->result_array()
		);
		$this->template->view('user/add_user', $this->data);
	}

	/**
	 * Handle Insert data
	 *
	 * @return void
	 **/
	public function insert()
	{
		$this->user->insert();
		redirect('user');
	}

	/**
	 * Auth username from database
	 *
	 * @param String
	 * @return Qeury Result
	 **/
	public function getusername()
	{
		// get query prepare statmennts
		$query = $this->db->query("SELECT * FROM tb_users WHERE username = ?", array($this->input->post('username')));

		if($query->num_rows() == 1)
		{
			$output['valid'] = FALSE;

		} else {
			$output['valid'] = TRUE;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Get edit Form user
	 *
	 * @return html output
	 **/
	public function get($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'All Users', 'user');
		$this->breadcrumbs->unshift(3, 'Update User', 'get');
		$this->page_title->push('Settings', 'Update User');

		$this->data = array(
			'title' => "Update User",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->user->get($param),
			'role_access' => $this->user->get_role()->result_array()
		);
		$this->template->view('user/edit_user', $this->data);
	}

	/**
	 * Handle Update User
	 *
	 * @param Integer ID_user
	 * @return void
	 **/
	public function updateuser($param = 0)
	{
		$this->user->update($param);
		redirect("user/get/{$param}");
	}

	/**
	 * Handle Delete User
	 *
	 * @param Integer ID_user
	 * @return void
	 **/
	public function delete($param = 0)
	{
		$this->user->delete($param);
		redirect('user');
	}

	/**
	 * Handle Multiple Action
	 *
	 * @return String
	 **/
	public function bulkuser()
	{
		switch ($this->input->post('action')) 
		{
			case 'set_update':
				$this->multiple_update();
				break;
			case 'update':
				$this->user->multiple_update();
				redirect('user');
				break;
			case 'delete':
				$this->user->multiple_delete();
				redirect('user');
				break;
			default:
				$this->template->alert(
					' Tidak ada data yang dipilih.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}
	}

	/**
	 * Multiple Form update
	 *
	 * @access private
	 * @return Html Output
	 **/
	private function multiple_update()
	{
		$this->breadcrumbs->unshift(2, 'All Users', 'user');
		$this->breadcrumbs->unshift(3, 'Update User', 'get');
		$this->page_title->push('Settings', 'Update User');

		$this->data = array(
			'title' => "Update User",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'role_access' => $this->user->get_role()->result_array()
		);
		$this->template->view('user/multiple_edit_user', $this->data);
	}


	/**
	 * Get Account Setting page
	 *
	 * @return html output
	 **/
	public function account()
	{
		$this->breadcrumbs->unshift(2, 'Settings', 'account');
		$this->page_title->push('Settings', 'Login Setting');

		$this->data = array(
			'title' => "Login Setting",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('user/account', $this->data);
	}

	/**
	 * Mengecek benarnya password lama
	 *
	 * @return String
	 **/
	public function authpass()
	{
		$password = $this->input->post('old_pass');

		$get = $this->user->get( $this->session->userdata('user')->user_id);
        // authentifaction dengan password verify
        if (password_verify($password,$get->password)) 
        {
			$output['valid'] = TRUE;

		} else {
			$output['valid'] = FALSE;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Setting account (Ganti Password)
	 *
	 * @return void
	 **/
	public function account_setting()
	{
		$this->user->update_account();
		redirect('user/account');
	}


	/**
	 * Setting Privilegs User
	 *
	 * @return Html Output
	 **/
	public function role()
	{
		$this->breadcrumbs->unshift(2, 'User Privileges', 'role');
		$this->page_title->push('Settings', 'User Privileges');

		$this->data = array(
			'title' => "User Privileges",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'role_access' => $this->user->get_role()->result()
		);
		$this->template->view('user/user_role', $this->data);
	}

	/**
	 * From Add Privilegs User
	 *
	 * @return Html Output
	 **/
	public function addrole()
	{
		$this->breadcrumbs->unshift(2, 'User Privileges', 'role');
		$this->breadcrumbs->unshift(3, 'Add New', 'adduser');
		$this->page_title->push('Settings', 'User Privileges');

		$this->data = array(
			'title' => "Add New Privileges",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files()
		);
		$this->template->view('user/add_role', $this->data);
	}

	/**
	 * Insert Privileges User
	 *
	 * @var string
	 **/
	public function insertrole()
	{
		$this->user->insertPrivileges();
		redirect('user/addrole');
	}

	/**
	 * From Update Privilegs User
	 *
	 * @return Html Output
	 **/
	public function getrole($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'User Privileges', 'role');
		$this->breadcrumbs->unshift(3, 'Update', 'adduser');
		$this->page_title->push('Settings', 'User Privileges');

		$this->data = array(
			'title' => "Update Privileges",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->user->get_role($param)->row()
		);

		$this->template->view('user/edit_role', $this->data);
	}

	/**
	 * Update Privileges User
	 *
	 * @return string
	 **/
	public function updaterole($param = 0)
	{
		$this->user->updatePrivileges($param);	
		redirect("user/getrole/{$param}");
	}

	/**
	 * Delete Privileges User
	 *
	 * @return string
	 **/
	public function deleterole($param = 0)
	{
		$this->user->deletePrivileges($param);	
		redirect("user/role");
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */