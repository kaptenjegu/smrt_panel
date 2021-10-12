<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {
	
	public function getData()
	{
		$this->db->where('aktif', 1);
		$result = $this->db->get($this->db->dbprefix . 'kategori')->result();
		return $result;
	}
	public function getDataByID($id)
	{
		$this->db->where('id_kategori', (int)$id);
		$this->db->where('aktif', 1);
		$result = $this->db->get($this->db->dbprefix . 'kategori')->result();
		return $result;
	}
	
	public function addData($data)
	{
		$q = "INSERT INTO " . $this->db->dbprefix . "kategori(id_kategori, nama_kategori, aktif) VALUES('', '" . $this->db->escape_str($data['nama_kategori']) . "', " . $data['aktif'] . ")";
		if ( ! $this->db->simple_query($q))
		{
			$error = $this->db->error(); // Has keys 'code' and 'message'
			$result['status'] = 'gagal';
			$result['pesan'] = $error['message'];
		}else{
			$result['status'] = 'sukses';
			$result['pesan'] = '';
		}
		return $result;
	}
	public function editData($data)
	{
		$q = "UPDATE " . $this->db->dbprefix . "kategori SET nama_kategori = '" . $this->db->escape_str($data['nama_kategori']) . "' WHERE id_kategori = '" . (int)$data['id_kategori'] . "'";
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
		$q = "UPDATE " . $this->db->dbprefix . "kategori SET aktif = 0 WHERE id_kategori = '" . (int)$data . "'";
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
