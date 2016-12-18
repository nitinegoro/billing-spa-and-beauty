<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mroom extends CI_Model {

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('q') != '')
			$this->db->like('room_name', $this->input->get('q'))
					->or_like('facilities', $this->input->get('q'))
					->or_like('room_description', $this->input->get('q'));

		if($this->input->get('status') !='')
			$this->db->where('room_status', $this->input->get('status'));

		if($type == 'result')
		{
			return $this->db->get('tb_rooms', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_rooms')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$query = $this->db->query("SELECT * FROM tb_rooms WHERE ID_room = ?", array($param));
		return $query->row();
	}

	public function insert()
	{
		$room = array(
			'room_name' => $this->input->post('name'),
			'facilities' => $this->input->post('facilities'),
			'room_description' => $this->input->post('description'),
			'image' => $this->upload_image(),
			'room_status' => 1 
		);

		$this->db->insert('tb_rooms', $room);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Success adding room.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Set Upload file foto
	 *
	 * @return string (file name)
	 **/
	private function upload_image()
	{
		$config['upload_path'] = 'assets/images';
		$config['allowed_types'] = 'gif|jpg|png|JPG|PNG';
		$config['max_size']  = '3072';
		$config['encrypt_name'] = TRUE;
		
		$this->upload->initialize($config);
		
		// set foto ktm mahasiswa 
		$file_foto = (!$this->upload->do_upload('image')) ? "" : $this->upload->file_name;

		return $file_foto;
	}

	public function update($param = 0)
	{
		$get = $this->get($param);

		// upload file
		$uploading_file = $this->upload_image();

		if($uploading_file != '')
		{
			// hapus foto lama
			if($get->foto != '')
				unlink("assets/images/{$get->image}");

			// ganti dgn yg baru
			$file_foto = $uploading_file;
		} else {
			$file_foto = $get->image;
		}

		$room = array(
			'room_name' => $this->input->post('name'),
			'facilities' => $this->input->post('facilities'),
			'room_description' => $this->input->post('description'),
			'image' => $uploading_file,
		);

		$this->db->update('tb_rooms', $room, array('ID_room' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Room changed.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function multiple_update()
	{
		if (is_array($this->input->post('room-id'))) 
		{
			foreach ($this->input->post('room-id') as $key => $value) 
			{
				$room = array(
					'room_name' => $this->input->post('name')[$key],
					'facilities' => $this->input->post('facilities')[$key],
					'room_description' => $this->input->post('description')[$key],
				);

				$this->db->update('tb_rooms', $room, array('ID_room' => $value));
			}
		} else {
			$this->template->alert(
				' Empty selected.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	public function delete($param = 0)
	{
		$this->db->update('tb_booking', array('booking_room_id' => 1), array('booking_room_id' => $param));

		$this->db->delete('tb_rooms', array('ID_room' => $param));

		$this->template->alert(
			' Room deleted.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function multiple_delete()
	{
		if (is_array($this->input->post('rooms'))) 
		{
			foreach ($this->input->post('rooms') as $key => $value) 
			{
				$this->db->update('tb_booking', array('booking_room_id' => 1), array('booking_room_id' => $value));

				$this->db->delete('tb_rooms', array('ID_room' => $value));
			}
			$this->template->alert(
				' Room deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Empty selected.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}
}

/* End of file Mroom.php */
/* Location: ./application/modules/Master/models/Mroom.php */