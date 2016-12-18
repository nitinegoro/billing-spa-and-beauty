<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Application 
{
	public function __construct()
	{
		parent::__construct();
		$this->breadcrumbs->unshift(1, 'Settings', 'setting');
		// antsipasi user nakal
		if($this->session->userdata('user')->user_id > 1)
			show_404();
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Application Settings', 'setting');
		$this->page_title->push('Settings', 'Application Settings');

		$this->data = array(
			'title' => "Application Settings",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('user/app_setting', $this->data);	
	}


	/**
	 * Set Configuration 
	 *
	 * @return String
	 **/
	public function set()
	{
		if(is_array($this->input->post('set')))
		{
			foreach ($this->input->post('set') as $key => $value) 
			{
				$this->app->update($key, $value);
			}
		}

		$this->template->alert(
			' Settings saved.', 
			array('type' => 'success','icon' => 'check')
		);

		redirect('setting');
	}
}

/* End of file Setting.php */
/* Location: ./application/controllers/Setting.php */