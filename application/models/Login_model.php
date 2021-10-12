<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	public function cek_akun($data)
	{
		$this->db->where('username', $this->db->escape_str($data['username']));
		$this->db->where('password', md5($data['password']));
		$this->db->where('aktif', 1);
		$this->db->limit(1);
		$dt = $this->db->get($this->db->dbprefix . 'akun');
		if($dt->num_rows()==1){
			return 1;			
		}else{
			return 0;
		}
	}
	public function get_akun($data)
	{
		$this->db->where('username', $this->db->escape_str($data['username']));
		$this->db->where('password', md5($data['password']));
		$this->db->where('aktif', 1);
		$this->db->limit(1); 
		$dt = $this->db->get($this->db->dbprefix . 'akun')->result();
		$result['username'] = $dt[0]->username;
		$result['role'] = $dt[0]->role;
		return $result;
	}
}
