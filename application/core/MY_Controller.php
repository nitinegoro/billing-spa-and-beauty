<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

	}
}


/**
* 
*/
class Application extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','breadcrumbs','page_title','config','table'));

		$this->load->helper(array('menus'));
		
		$this->load->model('option','app');
		
		date_default_timezone_set('Asia/Jakarta');

		$this->breadcrumbs->unshift(0, 'Dashboard', 'main');

		if($this->session->has_userdata('is_login')==FALSE)
			redirect('login?from_url='.current_url());
	}

	/**
	 * Mengubah JSON dan mengecek kebenaran object
	 *
	 * @access public
	 * @return string
	 **/
	public function radio_role($param)
	{
		echo "Ok";
	}

}




/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */