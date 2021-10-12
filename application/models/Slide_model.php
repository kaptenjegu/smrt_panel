<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slide_model extends CI_Model {
	
	public function getData()
	{
		$this->db->where('aktif', 1);
		$result = $this->db->get($this->db->dbprefix . 'slide')->result();
		return $result;
	}
	public function getDataByID($id)
	{
		$this->db->where('id_slide', (int)$id);
		$this->db->where('aktif', 1);
		$result = $this->db->get($this->db->dbprefix . 'slide')->result();
		return $result;
	}
	public function addData($data)
	{
		$q = "INSERT INTO " . $this->db->dbprefix . "slide(id_slide, keterangan, aktif) VALUES('', '" . $data['txt_slide'] . "', " . $data['aktif'] . ")";
		if ( ! $this->db->simple_query($q))
		{
			$error = $this->db->error(); // Has keys 'code' and 'message'
			$result['status'] = 'gagal';
			$result['pesan'] = $error['message'];
		}else{
			$result['status'] = 'sukses';
			$result['pesan'] = '';
			$this->db->where('aktif', 1);
			$this->db->order_by('id_slide', 'DESC');
			$hasil = $this->db->get($this->db->dbprefix . 'slide')->result();
			$result['id'] = $hasil[0]->id_slide;
		}
		return $result;
	}
	public function editData($data)
	{
		$q = "UPDATE " . $this->db->dbprefix . "slide SET keterangan = '" . $data['txt_slide'] . "' WHERE id_slide = " . (int)$data['id_slide'];
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
	public function deleteData($data)
	{
		$q = "DELETE FROM " . $this->db->dbprefix . "slide WHERE id_slide = " . (int)$data;
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
