<?php


class Custom404 extends CI_Controller
{

	public function index()
	{
		$data['logged'] = $this->session->userdata('isUserLoggedIn');
		$data['loggedAdmin'] = $this->session->userdata('isAdminLoggedIn');

		$this->load->view('elements/header', $data);
		$this->load->view('errors/custom404');
		$this->load->view('elements/footer');
	}

}
