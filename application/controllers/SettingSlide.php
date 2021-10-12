<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SettingSlide extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->Session_model->cek();
	}
	public function index()
	{		
		$this->load->model('Slide_model');
		$data['result'] = $this->Slide_model->getData();
		
		if(isset($_SESSION['status']) AND $_SESSION['status'] == 'sukses'){
			$data['pesan'] = '<label class="label-success" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data slide berhasil   !!!</label><br>';
		}elseif(isset($_SESSION['status']) AND $_SESSION['status'] == 'gagal'){
			$data['pesan'] = '<label class="label-danger" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data slide gagal, alasan : ' . $_SESSION['status_msg'] . '   !!!</label><br>';
		}else{
			$data['pesan'] = '';
		}
		unset($_SESSION['status']);
		unset($_SESSION['mode']);
		$data['page'] = 'slide';
		$this->load->view('template', $data);	
	}
	public function add()
	{		
		$this->load->model('Slide_model');
		$data = array(
			'txt_slide' => $this->input->post('txt_slide'),
			'aktif' => 1
		);
		$result = $this->Slide_model->addData($data);
		
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
			if($_FILES['img_slide']['type'] == 'image/jpeg'){
				$directory = "../image_utama/slider/";
				$location = $directory . 'slide' . $result['id'] . '.jpg';
				$temp_file = $_FILES['img_slide']['tmp_name'];
				move_uploaded_file($temp_file, $location);
			}
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Tambah';
		redirect('slide');
	}
	public function getDataByID()
	{
		$this->load->model('Slide_model');
		$result = $this->Slide_model->getDataByID($this->uri->segment(3));
		$result = json_encode($result);
		echo $result;
	}
	public function edit()
	{		
		$this->load->model('Slide_model');
		$data = array(
			'id_slide' => $this->input->post('id'),
			'txt_slide' => $this->input->post('txt_slide')
		);
		$result = $this->Slide_model->editData($data);
		
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
			if($_FILES['img_slide']['type'] == 'image/jpeg'){
				$directory = "../image_utama/slider/";
				$location = $directory . 'slide' . $this->input->post('id') . '.jpg';
				$temp_file = $_FILES['img_slide']['tmp_name'];
				move_uploaded_file($temp_file, $location);
			}
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Edit';
		redirect('slide');
	}
	public function hapus()
	{		
		$this->load->model('Slide_model');
		$result = $this->Slide_model->deleteData($this->uri->segment(3));
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Hapus';
		redirect('slide');
	}
	
}
