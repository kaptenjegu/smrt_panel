<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_model extends CI_Model {
	
	public function getData()
	{
		$this->db->where('id_about', 1);
		$result = $this->db->get($this->db->dbprefix . 'about')->result();
		return $result;
	}
	
	public function saveData($data)
	{
		$q = "UPDATE " . $this->db->dbprefix . "about SET text_about = '" . $data['txt_about'] . "' WHERE id_about = 1";
		if ( ! $this->db->simple_query($q))
		{
			$error = $this->db->error();
			$result['status'] = 'gagal';
			$result['pesan'] = $error['message'];
		}else{
			$result['status'] = 'sukses';
			$result['pesan'] = '';
		}
		return $result;
	}
	
}
