<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['loggedAdmin'] = $this->session->userdata['isAdminLoggedIn'];
		$this->load->view('elements/header', $data);
		$this->load->view('admin/left-panel');
		$this->load->view('admin/index', $data);
		$this->load->view('elements/footer');
	}


}
