<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends application {

	public function __construct()
	{
		parent::__construct();
		$this->load->js(base_url('assets/app/customer.js'));

		$this->load->model('mcustomer', 'customer');

		$this->breadcrumbs->unshift(1, 'Customers', 'customer');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'All Customers', 'customer');

		$this->page_title->push('Customers', 'All Customers');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("customer?q={$this->input->get('q')}&per_page={$this->input->get('per_page')}");
		$config['per_page'] = $this->input->get('per_page');
		$config['total_rows'] = $this->customer->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "All Customers",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'customers' => $this->customer->get_all($config['per_page'], $this->input->get('page')),
			'total_rows' => $config['total_rows'],
		);
		$this->template->view('data_customer', $this->data);
	}

	public function add()
	{
		$this->breadcrumbs->unshift(2, 'Add Customers', 'customer');

		$this->page_title->push('Customers', 'Add Customers');

		$this->data = array(
			'title' => "Add Customers",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('add_customer', $this->data);
	}

	public function insert()
	{
		$this->customer->insert();
		redirect('customer');
	}

	public function get($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'Update Customers', 'customer');

		$this->page_title->push('Customers', 'Update Customers');

		$this->data = array(
			'title' => "Update Customers",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->customer->get($param)
		);
		$this->template->view('update_customer', $this->data);
	}

	public function update($param = 0)
	{
		$this->customer->update($param);
		redirect("customer/get/{$param}");
	}

	public function delete($param = 0)
	{
		$this->customer->delete($param);
		redirect('customer');
	}

	public function bulkaction()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->customer->multiple_delete();
				redirect('customer');
				break;
			
			default:
				$this->template->alert(
					' Empty selected.', 
					array('type' => 'danger','icon' => 'times')
				);
				redirect('customer');
				break;
		}
	}
}

/* End of file Customer.php */
/* Location: ./application/modules/Customer/controllers/Customer.php */