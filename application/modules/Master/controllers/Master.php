<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends Application 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->js(base_url('assets/app/master.js'));

		$this->load->model('mroom', 'room');

		$this->load->model('mpackage', 'package');

		$this->breadcrumbs->unshift(1, 'Master', 'master');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Rooms Management', 'master');

		$this->page_title->push('Master', 'Rooms Management');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("master?q={$this->input->get('q')}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->room->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Rooms Management",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'rooms' => $this->room->get_all($config['per_page'], $this->input->get('page')),
		);
		$this->template->view('data_room', $this->data);
	}

	/**
	 * Form Add Room
	 *
	 * @return Html Output
	 **/
	public function addroom()
	{
		$this->breadcrumbs->unshift(2, 'Rooms Management', 'master');
		$this->breadcrumbs->unshift(2, 'Add Room', "master/addroom");

		$this->page_title->push('Master', 'Add Room');

		$this->data = array(
			'title' => "Add Room",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files()
		);
		$this->template->view('add_room', $this->data);
	}

	/**
	 * Insert New Room
	 *
	 * @return Void
	 **/
	public function insertroom()
	{
		$this->room->insert();
		redirect('master/addroom');
	}

	/**
	 * Form Update Room
	 *
	 * @param Integer ID_room
	 * @return Html Output
	 **/
	public function getroom($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'Rooms Management', 'master');
		$this->breadcrumbs->unshift(3, 'Update Room', "master/getroom/{$param}");

		$this->page_title->push('Master', 'Update Room');

		$this->data = array(
			'title' => "Update Room",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->room->get($param)
		);
		$this->template->view('update_room', $this->data);
	}

	/**
	 * Update Data Room
	 *
	 * @return Void
	 **/
	public function updateroom($param = 0)
	{
		$this->room->update($param);
		redirect("master/getroom/{$param}");
	}

	/**
	 * Multiple Action Room
	 *
	 * @return Void
	 **/
	public function bulkroom()
	{
		switch ($this->input->post('action')) 
		{
			case 'set_update':
				$this->multiple_update_room();
				break;
			case 'update':
				$this->room->multiple_update();
				redirect('master');
				break;
			case 'delete':
				$this->room->multiple_delete();
				redirect('master');
				break;
			default:
				$this->template->alert(
					' Empty selected.', 
					array('type' => 'danger','icon' => 'times')
				);
				redirect('master');
				break;
		}
	}

	/**
	 * Form Multile Update
	 *
	 * @access private
	 * @return Html Output
	 **/
	private function multiple_update_room()
	{
		$this->breadcrumbs->unshift(2, 'Rooms Management', 'master');
		$this->breadcrumbs->unshift(3, 'Update Room', "master");

		$this->page_title->push('Master', 'Update Room');

		$this->data = array(
			'title' => "Update Room",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('multiple_update_room', $this->data);
	}

	/**
	 * Delete Room Data
	 *
	 * @return Void
	 **/
	public function deleteroom($param = 0)
	{
		$this->room->delete($param);
		redirect('master');
	}

	/**
	 * Halaman List Package
	 *
	 * @return Html Output
	 **/
	public function package()
	{
		$this->breadcrumbs->unshift(2, 'Service And Package', 'master/package');

		$this->page_title->push('Master', 'Service And Package');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("master/package?q={$this->input->get('q')}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->room->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Service And Package",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'package' => $this->package->get_all($config['per_page'], $this->input->get('page'))
		);
		$this->template->view('data_package', $this->data);
	}

	/**
	 * Form Add Package
	 *
	 * @return Html Output
	 **/
	public function addpackage()
	{
		$this->breadcrumbs->unshift(2, 'Service And Package', 'master/package');
		$this->breadcrumbs->unshift(3, 'Add Package', "master/addpackage");

		$this->page_title->push('Master', 'Add Package');

		$this->data = array(
			'title' => "Add Package",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'rooms' => $this->package->getRoom()
		);
		$this->template->view('add_package', $this->data);
	}

	/**
	 * Add Package
	 *
	 * @return Void
	 **/
	public function insertpackage()
	{
		$this->package->insert();
		redirect('master/package');
	}

	/**
	 * Form Update Package
	 *
	  * @param Integer (packae_id)
	 * @return Void
	 **/
	public function getpackage($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'Service And Package', 'master/package');
		$this->breadcrumbs->unshift(3, 'Update Package', "master/getpackage");

		$this->page_title->push('Master', 'Update Package');

		$this->data = array(
			'title' => "Update Package",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->package->get($param),
			'rooms' => $this->package->getRoom()
		);
		$this->template->view('update_package', $this->data);
	}

	/**
	 * Update Package
	 *
	 * @param Integer package_ID
	 * @return Void
	 **/
	public function updatepackage($param = 0)
	{
		$this->package->update($param);
		redirect("master/getpackage/{$param}");
	}

	/**
	 * Delete Package
	 *
	 * @param Integer package_ID
	 * @return Void
	 **/
	public function deletepackage($param = 0)
	{
		$this->package->delete($param);
		redirect('master/package');
	}

	/**
	 * Multiple Action Room
	 *
	 * @return Void
	 **/
	public function bulkpackage()
	{
		switch ($this->input->post('action')) 
		{
			case 'set_update':
				$this->multiple_update_package();
				break;
			case 'update':
				$this->package->multiple_update();
				redirect('master/package');
				break;
			case 'delete':
				$this->package->multiple_delete();
				redirect('master/package');
				break;
			default:
				$this->template->alert(
					' Empty selected.', 
					array('type' => 'danger','icon' => 'times')
				);
				redirect('master/package');
				break;
		}
	}

	/**
	 * Form multiple Update Package
	 *
	 * @return Html Output
	 **/
	public function multiple_update_package()
	{
		$this->breadcrumbs->unshift(2, 'Service And Package', 'master/package');
		$this->breadcrumbs->unshift(3, 'Update Package', "master/getpackage");

		$this->page_title->push('Master', 'Update Package');

		$this->data = array(
			'title' => "Update Package",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'rooms' => $this->package->getRoom()
		);
		$this->template->view('multiple_update_package', $this->data);
	}

}

/* End of file Master.php */
/* Location: ./application/modules/Master/controllers/Master.php */