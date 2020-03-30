<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oferta extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('oferta_model');
	}

	public function index()
	{
		$data = array(
			'oferta' => $this->oferta_model->getOferta(),
			'logged' => $this->session->userdata('isUserLoggedIn'),
			'loggedAdmin' => $this->session->userdata('isAdminLoggedIn')
		);
		$this->load->view('elements/header', $data);
		$this->load->view('oferta/index', $data);
		$this->load->view('elements/footer');
	}


}
