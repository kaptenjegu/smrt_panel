<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{		
		if(isset($_SESSION['login']) AND $_SESSION['login'] == 'gagal'){
			$data['pesan'] = '<label class="label-success" style="background-color : red;color: white;">!!! Login Gagal !!!</label><br>';
		}else{
			$data['pesan'] = '';
		}
		unset($_SESSION['login']);
		$this->load->view('login_view', $data);	
	}
	
	public function logout(){
		session_destroy();
		redirect('login');
	}
	
	public function cek(){
		$this->load->model('Login_model');
		$data['username'] = $this->input->post('user');
		$data['password'] = $this->input->post('pass');
		$result = $this->Login_model->cek_akun($data);
		if($result){
			$sess = $this->Login_model->get_akun($data);
			$_SESSION['username'] = $sess['username'];
			if($sess['role'] == 1){
				$_SESSION['role'] = 'spv';
			}else{
				$_SESSION['role'] = 'admin';
			}
			$_SESSION['login'] = true;
			redirect('home');
		}else{
			$_SESSION['login'] = 'gagal'; 
			redirect('login');
		}
	}
	
}
