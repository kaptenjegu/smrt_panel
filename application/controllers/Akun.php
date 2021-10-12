<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->Session_model->cek();
		$this->load->library('user_agent');
		if($_SESSION['role'] == 'admin'){
			redirect($this->agent->referrer());
		}
	}
	public function index()
	{		
		$this->load->model('Akun_model');
		$data['result'] = $this->Akun_model->getData();
		
		if(isset($_SESSION['status']) AND $_SESSION['status'] == 'sukses'){
			$data['pesan'] = '<label class="label-success" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data akun berhasil   !!!</label><br>';
		}elseif(isset($_SESSION['status']) AND $_SESSION['status'] == 'gagal'){
			$data['pesan'] = '<label class="label-danger" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data akun gagal, alasan : ' . $_SESSION['status_msg'] . '   !!!</label><br>';
		}else{
			$data['pesan'] = '';
		}
		unset($_SESSION['status']);
		unset($_SESSION['mode']);
		$data['page'] = 'akun';
		$this->load->view('template', $data);	
	}
	public function add()
	{		
		$this->load->model('Akun_model');
		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'role' => $this->input->post('role'),
			'aktif' => 1
		);
		$result = $this->Akun_model->addData($data);
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Tambah';
		redirect('akun');
	}
	public function getDataByID()
	{
		$this->load->model('Akun_model');
		$result = $this->Akun_model->getDataByID($this->uri->segment(3));
		$result = json_encode($result);
		echo $result;
	}
	public function edit()
	{		
		$this->load->model('Akun_model');
		$data = array(
			'id_akun' => $this->input->post('id'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);
		$result = $this->Akun_model->editData($data);
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Edit';
		redirect('akun');
	}
	public function hapus()
	{		
		$this->load->model('Akun_model');
		//echo (int)$this->uri->segment(3);die();
		$result = $this->Akun_model->deleteData($this->uri->segment(3));
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Hapus';
		redirect('akun');
	}
	public function change()
	{		
		$this->load->model('Akun_model');
		$this->load->library('user_agent');
		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);
		$result = $this->Akun_model->changePassword($data);
		redirect($this->agent->referrer());
	}
}
