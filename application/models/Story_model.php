<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Story_model extends CI_Model {
	
	public function getData()
	{
		$this->db->where('aktif', 1);
		$result = $this->db->get($this->db->dbprefix . 'story')->result();
		return $result;
	}
	public function getDataByID($id)
	{
		$this->db->where('id_story', (int)$id);
		$this->db->where('aktif', 1);
		$result = $this->db->get($this->db->dbprefix . 'story')->result();
		return $result;
	}
	public function addData($data)
	{
		$q = "INSERT INTO " . $this->db->dbprefix . "story(id_story, keterangan, aktif) VALUES('', '" . $data['keterangan'] . "', " . $data['aktif'] . ")";
		if ( ! $this->db->simple_query($q))
		{
			$error = $this->db->error(); // Has keys 'code' and 'message'
			$result['status'] = 'gagal';
			$result['pesan'] = $error['message'];
		}else{
			$result['status'] = 'sukses';
			$result['pesan'] = '';
			$this->db->where('aktif', 1);
			$this->db->order_by('id_story', 'DESC');
			$hasil = $this->db->get($this->db->dbprefix . 'story')->result();
			$result['id'] = $hasil[0]->id_story;
		}
		return $result;
	}
	public function editData($data)
	{
		$q = "UPDATE " . $this->db->dbprefix . "story SET keterangan = '" . $data['keterangan'] . "' WHERE id_story = " . (int)$data['id_story'];
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
		$q = "DELETE FROM " . $this->db->dbprefix . "story WHERE id_story = " . (int)$data;
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
