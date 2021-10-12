<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->Session_model->cek();
	}
	public function index()
	{		
		$this->load->model('Produk_model');
		$this->load->model('Kategori_model');
		$data['result'] = $this->Produk_model->getData();
		$data['kategori'] = $this->Kategori_model->getData();
		
		if(isset($_SESSION['status']) AND $_SESSION['status'] == 'sukses'){
			$data['pesan'] = '<label class="label-success" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data produk berhasil   !!!</label><br>';
		}elseif(isset($_SESSION['status']) AND $_SESSION['status'] == 'gagal'){
			$data['pesan'] = '<label class="label-danger" style="color: white;">!!!   ' . $_SESSION['mode'] . ' data produk gagal, alasan : ' . $_SESSION['status_msg'] . '   !!!</label><br>';
		}else{
			$data['pesan'] = '';
		}
		unset($_SESSION['status']);
		unset($_SESSION['mode']);
		$data['page'] = 'produk';
		$this->load->view('template', $data);	
	}
	public function add()
	{		
		$this->load->model('Produk_model');
		$data = array(
			'nama_produk' => $this->input->post('nama_produk'),
			'kategori' => $this->input->post('kategori'),
			'harga_produk' => $this->input->post('harga_produk'),
			'warna_produk' => $this->input->post('warna_produk'),
			'ukuran_produk' => $this->input->post('ukuran_produk'),
			'desc_produk' => $this->input->post('desc_produk'),
			'aktif' => 1
		);
		$result = $this->Produk_model->addData($data);
		
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
			if($_FILES['img_produk']['type'] == 'image/jpeg'){
				$directory = "../image_shop/produk/";
				$location = $directory . 'produkDepan' . $result['id'] . '.jpg';
				$location2 = $directory . 'produkBelakang' . $result['id'] . '.jpg';
				$temp_file = $_FILES['img_produk']['tmp_name'];
				$temp_file2 = $_FILES['img_produk2']['tmp_name'];
				move_uploaded_file($temp_file, $location);
				move_uploaded_file($temp_file2, $location2);
			}
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Tambah';
		redirect('produk');
	}
	public function getDataByID()
	{
		$this->load->model('Produk_model');
		$result = $this->Produk_model->getDataByID($this->uri->segment(3));
		$result = json_encode($result);
		echo $result;
	}
	public function edit()
	{		
		$this->load->model('Produk_model');
		$data = array(
			'id_produk' => $this->input->post('id'),
			'nama_produk' => $this->input->post('nama_produk'),
			'harga_produk' => $this->input->post('harga_produk'),
			'warna_produk' => $this->input->post('warna_produk'),
			'ukuran_produk' => $this->input->post('ukuran_produk'),
			'desc_produk' => $this->input->post('desc_produk'),
			'aktif' => 1
		);
		$result = $this->Produk_model->editData($data);
		
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
			if($_FILES['img_produk']['type'] == 'image/jpeg'){
				$directory = "../image_shop/produk/";
				$location = $directory . 'produkDepan' . (int)$this->input->post('id') . '.jpg';
				$location2 = $directory . 'produkBelakang' . (int)$this->input->post('id') . '.jpg';
				$temp_file = $_FILES['img_produk']['tmp_name'];
				$temp_file2 = $_FILES['img_produk2']['tmp_name'];
				move_uploaded_file($temp_file, $location);
				move_uploaded_file($temp_file2, $location2);
			}
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Edit';
		redirect('produk');
	}
	public function hapus()
	{		
		$this->load->model('Produk_model');
		$result = $this->Produk_model->deleteData($this->uri->segment(3));
		if($result['status'] == 'sukses')
		{
			$_SESSION['status'] = 'sukses';
			$_SESSION['status_msg'] = '';
		}else{
			$_SESSION['status'] = 'gagal';
			$_SESSION['status_msg'] = $result['pesan'];
		}
		$_SESSION['mode'] = 'Hapus';
		redirect('produk');
	}
	
}
