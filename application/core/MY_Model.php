<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	

}


/**
* 
*/
class Administrator_Model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','slug'));
	}

	/**
	 * Get Author ID
	 *
	 * @return Integer
	 **/
	public function author_id()
	{
		return $this->session->has_userdata('user_id');
	}

	/**
	 * set Slug post page
	 * 
	 * @param String
	 * @return string (slug uri)
	 **/
	public function set_post_slug($string = '')
	{
		$string = $this->slug->create_slug($string);
		$query = $this->db->query("SELECT post_uri FROM tb_posts WHERE post_uri = ?", array($string));

		if($query->num_rows() > 1)
		{
			return $this->slug->create_slug($string)."-".$query->num_rows();
		} else {
			return $this->slug->create_slug($string);
		}
	}

	/**
	 * Count Comments
	 *
	 * @param Integer (ID) tb_comments
	 * @return Integer
	 **/
	public function comments_count($post = 0)
	{
		$query = $this->db->query("
			SELECT 	comment_post_ID FROM tb_comments WHERE 	comment_post_ID = ?", array($post)
		);
		return $query->num_rows();
	}
}
/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */