<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index($cardName = 'index')
	{
		$data['logged'] = $this->session->userdata('isUserLoggedIn');
		$data['loggedAdmin'] = $this->session->userdata('isAdminLoggedIn');
		if ($cardName === 'users') {
			$data['userRows'] = $this->admin_model->getUsers();
		}
		if ($data['loggedAdmin']) {
			$this->load->view('elements/header', $data);
			$this->load->view('admin/left_panel');
			$this->load->view('admin/' . $cardName, $data);
			$this->load->view('elements/footer');
		} else {
			redirect('/');
		}
	}


}
