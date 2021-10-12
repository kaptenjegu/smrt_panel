<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SettingAbout extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->Session_model->cek();
	}
	public function index()
	{		
		$this->load->model('About_model');
		$data['result'] = $this->About_model->getData();
		
		if(isset($_SESSION['status']) AND $_SESSION['status'] == 'sukses'){
			$data['pesan'] = '<label class="label-success" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data about berhasil   !!!</label><br>';
		}elseif(isset($_SESSION['status']) AND $_SESSION['status'] == 'gagal'){
			$data['pesan'] = '<label class="label-danger" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data about gagal, alasan : ' . $_SESSION['status_msg'] . '   !!!</label><br>';
		}else{
			$data['pesan'] = '';
		}
		unset($_SESSION['status']);
		unset($_SESSION['mode']);
		$data['page'] = 'about';
		$this->load->view('template', $data);	
	}
	
	public function save()
	{		
		$this->load->model('About_model');
		$data = array(
			'txt_about' => $this->input->post('txt_about')
		);
		$result = $this->About_model->saveData($data);
		
		if($_FILES['img_about']['type'] == 'image/jpeg'){
			$directory = "../image_utama/";
			$location = $directory . 'about.jpg';
			$temp_file = $_FILES['img_about']['tmp_name'];
			move_uploaded_file($temp_file, $location);
		}
		
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Simpan';
		redirect('about');
	}
		
}
