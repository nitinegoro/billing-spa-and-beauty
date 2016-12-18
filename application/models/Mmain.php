<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmain extends CI_Model {

	public function getBookingDate()
	{
		// Satu Minggu terakhir
		$sub_week = date('Y-m-d', strtotime("-1 weeks")); 
		$from = ($this->input->get('from') != '') ? $this->input->get('from') : $sub_week;
		$end = ($this->input->get('end') != '') ? $this->input->get('end') : date('Y-m-d');

		$query = $this->db->query("SELECT * FROM tb_booking WHERE date BETWEEN ? AND ?", array($from, $end));

		return $query->result();
	}

	/**
	 * Select Sum Total Income
	 *
	 * @param String Date
	 * @return Integer
	 **/
	public function sumIncome($date = '')
	{
		$query = $this->db->query("
			SELECT *, SUM(tb_payments.total_payments) AS total_payments FROM tb_payments
			LEFT JOIN tb_booking ON tb_payments.booking_payment_id = tb_booking.booking_id
			WHERE tb_booking.date = ?
		", array($date));
		return (!$query->row('total_payments')) ? null : $query->row('total_payments');
	}

	/**
	 * Select Sum Total Tax
	 *
	 * @param String Date
	 * @return Integer
	 **/
	public function sumTax($date = '')
	{
		$query = $this->db->query("
			SELECT *, SUM(tb_payments.tax_total) AS tax_total FROM tb_payments
			LEFT JOIN tb_booking ON tb_payments.booking_payment_id = tb_booking.booking_id
			WHERE tb_booking.date = ?
		", array($date));
		return (!$query->row('tax_total')) ? null : $query->row('tax_total');
	}

	/**
	 * Count Sum Transaction
	 *
	 * @param String Date
	 * @return Integer
	 **/
	public function countTransactions($date = '')
	{
		$query = $this->db->query("SELECT tb_payments.payment_id FROM tb_payments LEFT JOIN tb_booking ON tb_payments.booking_payment_id = tb_booking.booking_id WHERE tb_booking.date = ?", array($date));
		return $query->num_rows();
	}

	/**
	 * Count Available Rooms
	 *
	 * @param Integer
	 * @return Integer
	 **/
	public function countRooms($value='')
	{
		$query = $this->db->query("SELECT ID_room FROM tb_rooms WHERE room_status = ?", array($value));
		return $query->num_rows();
	}

	/**
	 * Get Package Data
	 *
	 * @return Result
	 **/
	public function getPackages()
	{
		$query = $this->db->query("SELECT package_name, package_ID FROM tb_package");
		return $query->result();
	}

	/**
	 * Percentage Package Fafvorites
	 *
	 * @param Integer (package_ID)
	 * @return Integer Float
	 **/
	public function getPercentagePackage($value='', $from = '', $end = '')
	{
		$query = $this->db->query("SELECT booking_package_id, booking_customer_id, date FROM tb_booking WHERE booking_package_id = ? AND date BETWEEN ? AND ?", array($value, $from, $end));

		$percentage = ($query->num_rows() * $this->db->count_all('tb_customers')) / 100;

		return $percentage;
	}
}

/* End of file Mmain.php */
/* Location: ./application/models/Mmain.php */