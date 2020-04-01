<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Info extends CI_Controller
{
	public function index()
	{
		$data = array(
			'logged' => $this->session->userdata('isUserLoggedIn'),
			'loggedAdmin' => $this->session->userdata('isAdminLoggedIn')
		);
		$this->load->view('elements/header', $data);
		$this->load->view('info/index', $data);
		$this->load->view('elements/footer');
	}

}
