<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Application 
{

	private $start_date;

	private $end_date;

	private $range;

	public function __construct() 
	{
		parent::__construct();

		$this->load->js(base_url('assets/app/dashboard.js'));

		$this->load->model('mmain', 'main');

		$this->page_title->push('Dashboard', 'Overview & Stats');

		// Satu Minggu terakhir
		$sub_week = date('Y-m-d', strtotime("-1 weeks")); 

		$this->start_date = ($this->input->get('from') != '') ? $this->input->get('from') : $sub_week;
		$this->end_date = ($this->input->get('end') != '') ? $this->input->get('end') : date('Y-m-d');

		// Range 
		$this->range = date_range($this->start_date, $this->end_date);
	}

	public function index()
	{
		$this->data = array(
			'title' => "Main",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('main/main-view', $this->data);
	}


	public function linechart()
	{
		foreach ($this->range as $date) 
		{
			$output[] = array(
				'period' => $date,
				'income' => $this->main->sumIncome($date),
				'tax' => $this->main->sumTax($date)
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output, JSON_PRETTY_PRINT));
	}

	public function piechart()
	{
		$number = 3;
		foreach($this->main->getPackages() as $row)
		{
			$output[] = array(
				'label' => $row->package_name,
				'data' => $this->main->getPercentagePackage($row->package_ID, $this->start_date, $this->end_date),
				'color' => random_color($number++)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output, JSON_PRETTY_PRINT));
	}
}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */