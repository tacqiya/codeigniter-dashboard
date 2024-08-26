<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainpage extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$data['page'] = 'home';
		$this->load->view('welcome_message', $data);
	}

	public function admin_register() {
		$data['page'] = 'register';
		if ($this->input->post()) {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				$formData['login_status'] = date('Y-m-d H:i:s');
				$formData['active_status'] = date('Y-m-d H:i:s');
				$formData['last_login'] = '';
				$formData['last_logout'] = '';
				$formData['datetime'] = date('Y-m-d H:i:s');
				$insert_data = $this->dbconnect->insert(TBL_REGISTER, $formData);
			} else {
				$response = array('error' => true, 'message' => implode('<br/>', $this->form_validation->error_array()));
				echo json_encode($response);
				exit();
			}
		}
		$this->load->view('register', $data);
	}

	public function admin_login() {
		$data['page'] = 'login';
		if ($this->input->post()) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {

			} else {
				$response = array('error' => true, 'message' => implode('<br/>', $this->form_validation->error_array()));
				echo json_encode($response);
				exit();
			}
		}
		$this->load->view('login', $data);
	}

	public function dashboard() {
		$data['page'] = 'dashboard';
		$this->load->view('elements/header', $data);
		$this->load->view('elements/sidebar', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('elements/footer', $data);
	}
}
