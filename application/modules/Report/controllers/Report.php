<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Application {

	public function __construct()
	{
		parent::__construct();
		$this->load->js(base_url('assets/app/report.js'));

		$this->load->model('mpayment', 'payment');

		$this->breadcrumbs->unshift(1, 'Report', 'report');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Transactions', 'report');

		$this->page_title->push('Report', 'Transactions');	

		$filter = array(
			'q' => $this->input->get('q'),
			'from' => $this->input->get('from'),
			'end' => $this->input->get('end'),
			'user' => $this->input->get('user'),
			'per_page' => $this->input->get('per_page') 
		);

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("report?q={$filter['q']}&per_page={$filter['per_page']}&from={$filter['from']}&end={$filter['end']}&user={$filter['user']}");
		$config['per_page'] = $this->input->get('per_page');
		$config['total_rows'] = $this->payment->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Transactions",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'payments' => $this->payment->get_all($config['per_page'], $this->input->get('page')),
			'total_rows' => $config['total_rows'],
			'cashier' => $this->app->cashier()
		);
		$this->template->view('payments_history', $this->data);	
	}

	/**
	 * Form Udate Transaction
	 *
	 * @param Integer booking_id
	 * @return Html Output
	 **/
	public function getpayment($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'Transactions', 'report');
		$this->breadcrumbs->unshift(3, invoice_number($param), 'getpayment');

		$this->page_title->push('Report', 'Transactions <i class="ace-icon fa fa-angle-double-right"></i> ' . invoice_number($param));	

		$this->data = array(
			'title' => "Transactions",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->payment->get($param),
			'cashier' => $this->app->cashier(),
			'packages' => $this->payment->getPackage(),
		);
		$this->template->view('getpayment', $this->data);	
	}

	/**
	 * Update Payments
	 *
	 * @param Integr payment id
	 * @return Void
	 **/
	public function updatepayment($param = 0)
	{
		$this->payment->update($param);
		redirect("report/getpayment/{$param}");
	}

	/**
	 * Delete Payment
	 *
	 * @param Integr payment id
	 * @return Void
	 **/
	public function deletepayment($param = 0)
	{
		$this->payment->delete($param);
		redirect('report');
	}

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public function bulkaction()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->payment->multiple_delete();
				redirect('report');
				break;
			
			default:
				$this->template->alert(
				    ' Empty selected.', 
				    array('type' => 'danger','icon' => 'times')
		        );
		        redirect('report');
				break;
		}
	}

	/**
	 * Hitung pembelanjaan
	 *
	 * @param Integer booking_id
	 * @return String
	 **/
	public function printnota($param = 0)
	{
		$get = $this->payment->get($param);
		$this->load->view('print_nota', array('get'=>$get));
	}

	/**
	 * Page Print Report
	 *
	 * @return Html Output
	 **/
	public function print_out()
	{
		$data = array(
			'num_payment' => $this->payment->get_all(null, null, 'num'),
			'payments' => $this->payment->get_all($this->input->get('per_page'), $this->input->get('page')), 
		);
		$this->load->view('print_payments_history', $data);
	}

	/**
	 * Export data To Excel
	 *
	 * @return File Excel
	 **/
	public function export()
	{
		$data = $this->payment->get_all($this->input->get('per_page'), $this->input->get('page'));

		$this->load->library('Excel/PHPExcel');

		$objPHPExcel = new PHPExcel();

		$worksheet = $objPHPExcel->createSheet(0);

	    for ($cell='A'; $cell<='V'; $cell++)
	    {
	        $worksheet->getStyle($cell.'1')->getFont()->setBold(true);
	        $worksheet->getStyle($cell.'2')->getFont()->setBold(true);
	    }

	    $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

	    $worksheet->getStyle('A1:J1')->applyFromArray($style);
	    $worksheet->getStyle('D2:E2')->applyFromArray($style);

		// Header dokumen
		 $worksheet->setCellValue('A1', 'NO.')
		 		   ->mergeCells('A1:A2')
				   ->setCellValue('B1', 'ID')
				   ->mergeCells('B1:B2')
				   ->setCellValue('C1', 'Date')
				   ->mergeCells('C1:C2')
				   ->setCellValue('D1', 'Customer Name')
				   ->mergeCells('D1:D2')
				   ->setCellValue('E1', 'Items')
				   ->mergeCells('E1:F1')
				   ->setCellValue('E2', 'Package')
				   ->setCellValue('F2', 'Price')
				   ->setCellValue('G1', 'Tax')
				   ->mergeCells('G1:G2')
				   ->setCellValue('H1', 'Discount')
				   ->mergeCells('H1:H2')
				   ->setCellValue('I1', 'Total')
				   ->mergeCells('I1:I2')
				   ->setCellValue('J1', 'Cashier')
				   ->mergeCells('J1:J2');

		// Set Value Data
		$row_cell = 3; $number = 1;

		foreach($data as $row)
		{
			$date = new DateTime($row->date);

			$total = $this->payment->total(
						array(
							'tax' => $row->tax_total,
							'discount' => $row->discount,
							'price' => $row->price
						)
					);

			$worksheet->setCellValue('A'.$row_cell, $number++)
					  ->setCellValue('B'.$row_cell, invoice_number($row->payment_id))
					  ->setCellValue('C'.$row_cell, $date->format('d/m/Y '))
					  ->setCellValue('D'.$row_cell, $row->name)
					  ->setCellValue('E'.$row_cell, $row->package_name)
					  ->setCellValue('F'.$row_cell, $row->price)
					  ->setCellValue('G'.$row_cell, $row->tax_total)
					  ->setCellValue('H'.$row_cell, $total['discount'])
					  ->setCellValue('I'.$row_cell, $total['grandtotal'])
					  ->setCellValue('J'.$row_cell, $row->full_name);
			$row_cell++;
		}

		// Sheet Title
		$worksheet->setTitle("Report Transactions");

		$objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');\
        header('Content-Disposition: attachment; filename="REPORT-TRANSACTIONS.xlsx"');
        $objWriter->save("php://output");
	}
}

/* End of file Report.php */
/* Location: ./application/modules/Report/controllers/Report.php */