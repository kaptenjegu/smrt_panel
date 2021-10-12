<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_model extends CI_Model {
	
	public function getData()
	{
		$this->db->where('id_akun <> 1');
		$this->db->where('aktif', 1);
		$result = $this->db->get($this->db->dbprefix . 'akun')->result();
		return $result;
	}
	public function getDataByID($id)
	{
		$this->db->where('id_akun <> 1');
		$this->db->where('id_akun', (int)$id);
		$this->db->where('aktif', 1);
		$result = $this->db->get($this->db->dbprefix . 'akun')->result();
		return $result;
	}
	
	public function addData($data)
	{
		$q = "INSERT INTO " . $this->db->dbprefix . "akun(id_akun, username, password, role, aktif) VALUES('', '" . $this->db->escape_str($data['username']) . "', '" . $data['password'] . "', '" . (int)$data['role'] . "', " . $data['aktif'] . ")";
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
		$q = "UPDATE " . $this->db->dbprefix . "akun SET username = '" . $this->db->escape_str($data['username']) . "', password = '" . $data['password'] . "' WHERE id_akun = '" . (int)$data['id_akun'] . "'";
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
	public function changePassword($data)
	{
		$q = "UPDATE " . $this->db->dbprefix . "akun SET password = '" . $data['password'] . "' WHERE username = '" . $data['username'] . "'";
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
		$q = "DELETE FROM " . $this->db->dbprefix . "akun WHERE username = '" . $this->db->escape_str($data) . "' AND id_akun <> 1";
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
