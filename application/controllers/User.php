<?php


class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('form_validation');

		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		$this->isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
	}

	public function index()
	{
		if ($this->isUserLoggedIn || $this->isAdminLoggedIn) {
			redirect('user/account');
		} else {
			redirect('user/login');
		}
	}

	public function account()
	{
		$data = array();
		if ($this->isUserLoggedIn || $this->isAdminLoggedIn) {
			$con = array(
				'id' => $this->session->userdata('userId')
			);
			$data['user'] = $this->user_model->getRows($con);
			$data['logged'] = $this->isUserLoggedIn;
			$data['loggedAdmin'] = $this->isAdminLoggedIn;

			$this->load->view('elements/header', $data);
			$this->load->view('user/account', $data);
			$this->load->view('elements/footer');
		} else {
			redirect('user/login');
		}
	}

	public function login()
	{
		$data = array();

		if ($this->session->userdata('success_msg')) {
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if ($this->session->userdata('error_msg')) {
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msg');
		}

		if ($this->input->post('loginSubmit')) {
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|required');

			if ($this->form_validation->run() == true) {
				$con = array(
					'returnType' => 'single',
					'conditions' => array(
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
						'status' => 1
					)
				);
				$checkLogin = $this->user_model->getRows($con);

				if ($checkLogin) {
					$this->session->set_userdata('isUserLoggedIn', TRUE);
					$this->session->set_userdata('userId', $checkLogin['id']);
					redirect('user/account');
				} else {
					$data['error_msg'] = 'Wrong email or password!';
				}

				$con = array(
					'returnType' => 'single',
					'conditions' => array(
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
						'status' => 2
					)
				);
				$checkAdmin = $this->user_model->getRows($con);
				if ($checkAdmin) {
					$this->session->set_userdata('isAdminLoggedIn', TRUE);
					$this->session->set_userdata('userId', $checkAdmin['id']);
					redirect('user/account');
				} else {
					$data['error_msg'] = 'Wrong email or password!';
				}
			} else {
				$data['error_msg'] = 'Please fill all fields';
			}
		}
		$data['logged'] = $this->isUserLoggedIn;
		$data['loggedAdmin'] = $this->isAdminLoggedIn;
		$this->load->view('elements/header', $data);
		$this->load->view('user/login', $data);
		$this->load->view('elements/footer');
	}

	public function registration()
	{
		$data = $userData = array();

		if($this->input->post('signupSubmit')) {
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('login', 'Login', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('academic', 'Academic', 'required');
			$this->form_validation->set_rules('room', 'Room', 'required');

			if ($this->form_validation->run() == true) {
				$adresData = array(
					'akademik' => $this->input->post('academic'),
					'nr_pokoju' => $this->input->post('room')
				);

				$insertAdres = $this->user_model->insertAdres($adresData);

				$userData = array(
					'first_name' => strip_tags($this->input->post('first_name')),
					'login' => strip_tags($this->input->post('login')),
					'email' => strip_tags($this->input->post('email')),
					'password' => md5($this->input->post('password')),
					'id_adresu' => strip_tags($insertAdres)
				);
				$insert = $this->user_model->insert($userData);
				if ($insert) {
					$this->session->set_userdata('success_msg', 'Konto utworzone');
					redirect('user/login');
				} else {
					$data['error_msg'] = 'Error!';
				}


			} else {
				$data['error_msg'] = 'Fill all fields!';
			}
		}

		$data['user'] = $userData;
		$data['logged'] = $this->isUserLoggedIn;
		$data['loggedAdmin'] = $this->isAdminLoggedIn;
		$this->load->view('elements/header', $data);
		$this->load->view('user/registration', $data);
		$this->load->view('elements/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('isUserLoggedIn');
		$this->session->unset_userdata('isAdminLoggedIn');
		$this->session->unset_userdata('userId');
		$this->session->sess_destroy();
		redirect('user/login');
	}

	public function email_check($str)
	{
		$con = array(
			'returnType'=>'count',
			'conditions'=>array(
				'email'=>$str
			)
		);
		$checkEmail = $this->user_model->getRows($con);
		if($checkEmail>0)
		{
			$this->form_validation->set_message('email_check','The given email already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
