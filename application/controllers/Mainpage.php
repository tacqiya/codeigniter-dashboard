<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainpage extends DASH_Controller {
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
		$response = $this->session->flashdata('response');
		if ($this->input->post()) {
			extract($this->input->post());
			$formData = $this->input->post();
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == TRUE) {
				$formData['password'] = md5(md5(md5($password)));
				$formData['login_status'] = 0;
				$formData['active_status'] = 1;
				$formData['last_login'] = '';
				$formData['last_logout'] = '';
				$formData['datetime'] = date('Y-m-d H:i:s');
				// echo "<pre>"; print_r($formData); echo "</pre>";exit;
				$insert_data = $this->dbconnect->insert(TBL_USERS, $formData);
				if($insert_data) {
					$this->session->set_flashdata('response', array('type' => 'normal', 'error_type' => 'success', 'message' => 'Successfully register as administrator'));
					redirect(base_url('login'));
				}
			} else {
				$response = array('error' => true, 'message' => implode('<br/>', $this->form_validation->error_array()));
			}
		}
		$data['response'] = $response;
		$this->load->view('register', $data);
	}

	public function admin_login() {
		$data['page'] = 'login';
		$data['page_title'] = 'Log in';
		$response = $this->session->flashdata('response');
		$this->session->unset_userdata('logged_admin');

		if ($this->input->post()) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == TRUE) { 
				$email = $this->input->post('email');
                $password = md5(md5(md5($this->input->post('password'))));
				$checkQuery = $this->dbconnect->getWhere(TBL_USERS, compact('email', 'password'), true); //echo "<pre>"; print_r($password); echo "</pre>";exit;
				if ($checkQuery) { 
					$updateQuery = $this->dbconnect->update(TBL_USERS, array('id' => $checkQuery->id), array('login_status' => 1, 'active_status' => 1, 'last_login' => date('Y-m-d H:i:s')));
					if ($updateQuery) {
						$this->session->set_userdata('logged_admin', arrayToObject(array('id' => $checkQuery->id, 'username' => $checkQuery->username, 'email' => $checkQuery->email)));
						$this->session->set_flashdata('response', array('type' => 'normal', 'error_type' => 'success', 'message' => 'Welcome Administrator!'));
						if (!empty($this->input->get('redirect_url'))) {
							redirect(urldecode(base64_decode($this->input->get('redirect_url'))));
						} else {
							redirect(base_url('dashboard'));
						}
					} else {
						$response = array('type' => 'normal', 'error_type' => 'error', 'message' => 'Can\'t log into your account at the moment Please try again later!');
					}
				} else {
                    $response = array('type' => 'normal', 'error_type' => 'error', 'message' => 'Your Username or Password is incorrect.');
                }
			} else {
				$response = array('error' => true, 'message' => implode('<br/>', $this->form_validation->error_array()));
			}
		}
		$data['response'] = $response;
		$this->load->view('login', $data);
	}

	public function logout() {
		$recordUpdate = $this->dbconnect->update(TBL_USERS, array('id' => get_admin()->id), array('login_status' => 0, 'last_logout' => date('Y-m-d H:i:s')));
        if ($recordUpdate) {
            $this->session->unset_userdata('logged_admin');
            redirect(base_url('login/?logout=true'));
            exit();
        }
	}

	public function dashboard() {
		$this->__is_logged_user('ADMIN');
		$data['page'] = 'dashboard';
		$this->load->view('elements/header', $data);
		$this->load->view('elements/sidebar', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('elements/footer', $data);
	}
}
