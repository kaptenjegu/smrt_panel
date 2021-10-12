<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->Session_model->cek();
	}
	public function index()
	{		
		$this->load->model('Home_model');
		$data['result'] = $this->Home_model->getData();
		$data['page'] = 'dashboard';
		$this->load->view('template', $data);	
	}
	public function baca()
	{		
		$this->load->model('Home_model');
		$result = $this->Home_model->updateData($this->uri->segment(3));
		redirect('Home');
	}
}
