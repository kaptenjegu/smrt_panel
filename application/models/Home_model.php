<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
	
	public function getData()
	{
		$this->db->where('aktif', 1);
		$result = $this->db->get($this->db->dbprefix . 'mailing')->result();
		return $result;
	}
	public function updateData($data)
	{
		$q = "UPDATE " . $this->db->dbprefix . "mailing set aktif = 0 WHERE id_mailing = " . (int)$data['id_mailing'];
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
