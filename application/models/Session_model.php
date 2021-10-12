<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_model extends CI_Model {
	
	public function cek()
	{
		if(!isset($_SESSION['username']) AND !isset($_SESSION['role'])){
			$_SESSION['login'] = 'gagal'; 
			redirect('login');
		}
	}
	
}
