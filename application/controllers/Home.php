<?php

class Home extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data['logged'] = $this->session->userdata('isUserLoggedIn');
		$this->load->view('elements/header',$data);
		$this->load->view('home');
		$this->load->view('elements/footer');
	}

}
