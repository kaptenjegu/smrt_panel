<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->Session_model->cek();
	}
	public function index()
	{		
		$this->load->model('Kategori_model');
		$data['result'] = $this->Kategori_model->getData();
		
		if(isset($_SESSION['status']) AND $_SESSION['status'] == 'sukses'){
			$data['pesan'] = '<label class="label-success" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data kategori berhasil   !!!</label><br>';
		}elseif(isset($_SESSION['status']) AND $_SESSION['status'] == 'gagal'){
			$data['pesan'] = '<label class="label-danger" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data kategori gagal, alasan : ' . $_SESSION['status_msg'] . '   !!!</label><br>';
		}else{
			$data['pesan'] = '';
		}
		unset($_SESSION['status']);
		unset($_SESSION['mode']);
		$data['page'] = 'kategori';
		$this->load->view('template', $data);	
	}
	public function add()
	{		
		$this->load->model('Kategori_model');
		$data_post = array(
			'nama_kategori' => $this->input->post('nama'),
			'aktif' => 1
		);
		$result = $this->Kategori_model->addData($data_post);
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Tambah';
		redirect('kategori');
	}
	public function getDataByID()
	{
		$this->load->model('Kategori_model');
		$result = $this->Kategori_model->getDataByID($this->uri->segment(3));
		$result = json_encode($result);
		echo $result;
	}
	public function edit()
	{		
		$this->load->model('Kategori_model');
		$data = array(
			'id_kategori' => $this->input->post('id'),
			'nama_kategori' => $this->input->post('nama')
		);
		$result = $this->Kategori_model->editData($data);
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Edit';
		redirect('kategori');
	}
	public function hapus()
	{		
		$this->load->model('Kategori_model');
		$result = $this->Kategori_model->deleteData($this->uri->segment(3));
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Hapus';
		redirect('kategori');
	}
	
}
