<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_controller extends CI_Controller {
	
	public function __construct(){
			
				parent::__construct();
				
				$this->load->helper('form');
				$this->load->library("form_validation");
				$this->load->library('session');
				
	}
	
	public function index()
	{
		$data['error'] = '';
		$this->load->view('login', $data);
	}
	public function login_attempt(){
		$this->load->model('model_login');
		//setting form validation rules
		$this->form_validation->set_rules('user_username', 'Username', 'trim|required');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
		
		//setting of inputs in data array
		$data = array(
			'user_username' => $this->input->post('user_username'),
			'user_password' => md5($this->input->post('user_password'))
		);
		
		//checking if rules are done
		if($this->form_validation->run() == TRUE)
		{
			$check = $this->model_login->login($data['user_username'], $data['user_password']);
			
			//check if account exists
			if($check == TRUE)
			{
				//redirect to login page if account doesn't exists
				$data['error'] = "Account doesn't Exists";
				$this->load->view('login', $data);
			}
			else{
				if($this->session->userdata('status') != 0)
				{
					redirect('area_controller');
				}
				else
				{
					redirect('admin_controller');
				}
			}
		}
		else
		{
			$data['error'] = '';
			$this->load->view('login', $data);
		}
				
	}
}
