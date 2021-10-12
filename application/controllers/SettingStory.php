<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SettingStory extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->Session_model->cek();
	}
	public function index()
	{		
		$this->load->model('Story_model');
		$data['result'] = $this->Story_model->getData();
		
		if(isset($_SESSION['status']) AND $_SESSION['status'] == 'sukses'){
			$data['pesan'] = '<label class="label-success" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data story berhasil   !!!</label><br>';
		}elseif(isset($_SESSION['status']) AND $_SESSION['status'] == 'gagal'){
			$data['pesan'] = '<label class="label-danger" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data story gagal, alasan : ' . $_SESSION['status_msg'] . '   !!!</label><br>';
		}else{
			$data['pesan'] = '';
		}
		unset($_SESSION['status']);
		unset($_SESSION['mode']);
		$data['page'] = 'story';
		$this->load->view('template', $data);	
	}
	public function add()
	{		
		$this->load->model('Story_model');
		$data = array(
			'keterangan' => $this->input->post('keterangan'),
			'aktif' => 1
		);
		$result = $this->Story_model->addData($data);
		
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
			if($_FILES['img_story']['type'] == 'image/jpeg'){
				$directory = "../image_utama/story/";
				$location = $directory . 'story' . $result['id'] . '.jpg';
				$temp_file = $_FILES['img_story']['tmp_name'];
				move_uploaded_file($temp_file, $location);
			}
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Tambah';
		redirect('story');
	}
	public function getDataByID()
	{
		$this->load->model('Story_model');
		$result = $this->Story_model->getDataByID($this->uri->segment(3));
		$result = json_encode($result);
		echo $result;
	}
	public function edit()
	{		
		$this->load->model('Story_model');
		$data = array(
			'id_story' => $this->input->post('id'),
			'keterangan' => $this->input->post('keterangan')
		);
		$result = $this->Story_model->editData($data);
		
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
			if($_FILES['img_story']['type'] == 'image/jpeg'){
				$directory = "../image_utama/story/";
				$location = $directory . 'story' . $this->input->post('id') . '.jpg';
				$temp_file = $_FILES['img_story']['tmp_name'];
				move_uploaded_file($temp_file, $location);
			}
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Edit';
		redirect('story');
	}
	public function hapus()
	{		
		$this->load->model('Story_model');
		$result = $this->Story_model->deleteData($this->uri->segment(3));
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Hapus';
		redirect('story');
	}
	
}
